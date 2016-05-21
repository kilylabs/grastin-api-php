<?php

namespace Kily\Delivery\Grastin;

class Delivery {

    protected $api_key;
    protected $client;
    protected $options;   

    public function __construct($api_key,$options=[]) 
    {
        $this->api_key = $api_key;
        $this->setOptions($options);
        $this->setup();
    }

    protected function setup() {
        $this->client = new \GuzzleHttp\Client([
            'base_uri'=>$this->getOption('url'),
            'timeout'=>$this->getOption('timeout'),
            'debug'=>defined('GRASTIN_DEBUG'),

        ]); 
    }

    public function setOptions($options) {
        $defaultOptions = [
            'url'=>'http://api.grastin.ru/api.php',
            'timeout'=>30,
        ];
        $this->options = array_merge($defaultOptions,$options);
    }

    public function getOptions() {
        return $this->options;
    }

    public function setOption($name,$val) {
        return $this->options[$name] = $val;
    }

    public function getOption($name) {
        return $this->options[$name];
    }

    public function Orderinformation($orders,$dt_start=null,$dt_end=null)
    {
        if(is_string($orders)) $orders = [$orders];

        $params = [
            'Orders'=>[
                'Order'=>$orders
            ],
        ];
        if($dt_start) {
            $params['Datedeliverystart'] = $dt_start instanceof \DateTime ? $dt_start->format('dmY') : date('dmY',strtotime($dt_start));
        }
        if($dt_end) {
            $params['Datedeliverystart'] = $dt_end instanceof \DateTime ? $dt_end->format('dmY') : date('dmY',strtotime($dt_end));
        }

        $xml = $this->request(__FUNCTION__,$params);
        $data = $this->toArr($xml);

        $data = $data['Order'];
        if(!isset($data[0])) $data = [$data];
        foreach($data as $idx=>$o) {
            if(isset($data[$idx]['Places']['Place'])) {
                if(!isset($data[$idx]['Places']['Place'][0]))
                    $data[$idx]['Places'] = [$data[$idx]['Places']['Place']];
                else
                    $data[$idx]['Places'] = $data[$idx]['Places']['Place'];
            }
        }
        return is_array($orders) ? $data : $data[0];
    }

    public function Selfpickup()
    {
        $xml = $this->request(__FUNCTION__,[]);
        $data = $this->toArr($xml);
        return $data['Selfpickup'];
    }

    public function Warehouse()
    {
        $xml = $this->request(__FUNCTION__,[]);
        $data = $this->toArr($xml);
        return $data['Warehouse'];
    }

    public function Deliveryregion()
    {
        $xml = $this->request(__FUNCTION__,[]);
        $data = $this->toArr($xml);
        return $data['Region'];
    }

    public function boxberryselfpickup()
    {
        $xml = $this->request(__FUNCTION__,[]);
        $data = $this->toArr($xml);
        return $data['SelfpickupBoxberry'];
    }

    public function boxberrypostcode()
    {
        $xml = $this->request(__FUNCTION__,[]);
        $data = $this->toArr($xml);
        return $data['PostcodeBoxberry'];
    }

    public function hermesselfpickup()
    {
        $xml = $this->request(__FUNCTION__,[]);
        $data = $this->toArr($xml);
        return $data['SelfpickupHermes'];
    }

    public function statushistory($orders)
    {
        if(is_string($orders)) $orders = [$orders];

        $params = [
            'Orders'=>[
                'Order'=>$orders
            ],
        ];

        $xml = $this->request(__FUNCTION__,$params);
        $data = $this->toArr($xml);

        $data = $data['Order'];
        if(!isset($data[0])) $data = [$data];
        foreach($data as $idx=>$o) {
            if(isset($data[$idx]['Record'])) {
                if(!isset($data[$idx]['Record'][0]))
                    $data[$idx]['Record'] = [$data[$idx]['Record']];
            }
        }
        return is_array($orders) ? $data : $data[0];
    }

    public function printactofreceiving($orders)
    {
        if(is_string($orders)) $orders = [$orders];

        $params = [];
        foreach($orders as $order=>$seats) {
            if(is_int($order)) list($order,$seats) = [$seats,1];
            $params[] = ['@number'=>$order,'@seats'=>$seats];
        }

        $params = [
            'Orders'=>[
                'Order'=>$params,
            ],
        ];

        $resp = $this->request(__FUNCTION__,$params,true);
        $headers = $resp->getHeaders();
        $tmp = new \SplTempFileObject;
        $tmp->fwrite($resp->getBody());
        return $tmp;
    }



    protected function request($method,$params,$raw=false) {
        try {
            $out_xml = $this->toXml(array_merge([
                'API'=>$this->api_key,
                'Method'=>strtolower($method),
            ],$params));
            $response = $this->client->post('',[
                'form_params'=>[
                    'XMLPackage'=>$out_xml,
                ]
            ]);
        } catch(\GuzzleHttp\Exception\RequestException $e) {
            throw new GrastinException('Exception thrown while making request',0,$e);
        }
        if($raw) return $response;
        $xml_string = $response->getBody();
        $xml = @simplexml_load_string($xml_string);
        if(!$xml)
            throw new GrastinException('Bad response from Grastin: '.$xml_string);

        return $xml;
    }

    private function toXml(array $arr, \SimpleXMLElement $xml = null,$old_k=null)
    {
        if(!is_object($xml)) {
            $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><File/>');
        }
        foreach ($arr as $k => $v) {
            if(is_array($v)) {
                if(array_values($v) === $v) {
                    foreach($v as $pv) { 
                        if(is_array($pv)) {
                            $c = $xml->addChild($k);
                            foreach($pv as $kpv=>$vpv) {
                                if(strpos($kpv,'@') === 0)
                                    $c->addAttribute(substr($kpv,1),$vpv);
                                else 
                                    $c->addChild($kpv,$vpv);
                            }
                        } else {
                            $xml->addChild($k,$pv);
                        }
                    }
                } else {
                    $this->toXml($v, $xml->addChild($k),$k);
                }
            } else {
                $xml->addChild($k, $v);
            }
        }
        return $xml->asXML();
    }

    private function toArr($obj,$out=[])
    {
        $out = is_object($obj) ? json_decode(json_encode($obj),true) : $obj;
        $tmpout = $out;
        foreach($out as $k=>$v) {  
            if(is_array($v)) {
                if($v === []) {
                    if(!in_array($k,['Places'])) $tmpout[$k] = null;
                } else {
                    $tmpout[$k] = $this->toArr($v);
                }
            }
        }
        if(isset($tmpout['@attributes']))
            $tmpout = array_merge($tmpout['@attributes'],$tmpout);
        unset($tmpout['@attributes']);

        return $tmpout;
    }

}