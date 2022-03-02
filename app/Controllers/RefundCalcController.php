<?php

namespace App\Controllers;

class RefundCalcController extends BaseController{

    public function refund(){

        if ($this->request->getMethod() == 'post') {
            $data = [
                'event' => $this->request->getVar('event'),
                'totalDiscountWithCoupon' => $this->request->getVar('totalDiscountWithCoupon'),
                'totalPay' => $this->request->getVar('totalPay'),
                'pointPay' => $this->request->getVar('pointPay'),
                'step' => $this->request->getVar('step'),
                'countsAll' => $this->request->getVar('countsAll'),
                'already' => $this->request->getVar('already'),
            ];
            if ( is_null($data['pointPay']) ) {
                $cashPay = $data['totalPay'];
                $data['pointPay'] = 0;
            } else {
                $cashPay = $data['totalPay'] - $data['pointPay'];
            }

            $cashRatio = $cashPay / $data['totalPay'];

            if($data['event'] == "not"){
                $alreadyRatio = $data['already'] / $data['countsAll'];
                $beforeCoupon = $data['totalPay'] + $data['totalDiscountWithCoupon'];
                $originalPrice = 0;
                $oneDayPacks=0;
                switch($data['step']){
                    case 'A':
                        $originalPrice = 3200;
                        //$oneDayPacks = 6;
                        $oneDayPacks = 1;
                        break;

                    case 'B':
                        $originalPrice = 3600;
                        //$oneDayPacks = 6;
                        $oneDayPacks = 1;
                        break;

                    case 'C':
                        $originalPrice = 3900;
                        //$oneDayPacks = 6;
                        $oneDayPacks = 1;
                        break;

                    case 'D2':
                        $originalPrice = 4100;
                        //$oneDayPacks = 6;
                        $oneDayPacks = 1;
                        break;

                    case 'D3':
                        $originalPrice = 4100;
                        //$oneDayPacks = 9;
                        $oneDayPacks = 1;
                        break;

                    case 'DE':
                        $originalPrice = 4200;
                        //$oneDayPacks = 9;
                        $oneDayPacks = 1;
                        break;

                    case 'E':
                        $originalPrice = 4300;
                        //$oneDayPacks = 9;
                        $oneDayPacks = 1;
                        break;
                    case 'F':
                        $originalPrice = 4900;
                        //$oneDayPacks = 9;
                        $oneDayPacks = 1;
                        break;
                    case 'I':
                        $originalPrice = 4980;
                        //$oneDayPacks = 9;
                        $oneDayPacks = 1;
                        break;
                }

                if($alreadyRatio < 0.5){
                    $refundTotal = $data['totalPay'] - ($data['already'] * $oneDayPacks * $originalPrice);
                } else {
                    $refundTotal = $data['totalPay'] - ceil($beforeCoupon * $alreadyRatio);
                }
                $refundCash = intVal($refundTotal * $cashRatio); /* 포인트 제외 된 금액 */
                $refundPoint = ceil($data['pointPay'] * ($refundTotal/$data['totalPay']));

                $pointFees = $data['pointPay'] - $refundPoint;
                $cashFees = $cashPay - $refundCash;


                $refundData = [
                    'alreadyRatio' => $alreadyRatio,
                    'cashRatio' => $cashRatio,
                    'refundTotal' => number_format($refundTotal),
                    'refundCash' => number_format($refundCash),
                    'cashFees' => number_format($cashFees),
                    'refundPoint' => number_format($refundPoint),
                    'pointFees' => number_format($pointFees),
                ];

                return $this->response->setJSON($refundData);
            }
        }

    }


    public function refundPoint(){
        if ($this->request->getMethod() == 'post') {
            $data = [
                'totalCalculatedRefund' => $this->request->getVar('totalCalculatedRefund'),
                'pointPay' => $this->request->getVar('pointPay'),
                'totalPay' => $this->request->getVar('totalPay'),
            ];

            if ( is_null($data['pointPay']) ) {
                $cashPay = $data['totalPay'];
                $data['pointPay'] = 0;
            } else {
                $cashPay = $data['totalPay'] - $data['pointPay'];
            }

            $cashRatio = $cashPay / $data['totalPay'];

            $refundCash = intVal($data['totalCalculatedRefund'] * $cashRatio);
            $refundPoint = intVal($data['totalCalculatedRefund'] - $refundCash);

            $pointFees = $data['pointPay'] - $refundPoint;
            $cashFees = $cashPay - $refundCash;

            $refund34Point = [
                'cashRatio'=> $cashRatio,
                'totalCalculatedRefund'=> number_format($data['totalCalculatedRefund']),
                'refundCash'=> number_format($refundCash),
                'cashFees'=> number_format($cashFees),
                'refundPoint'=> number_format($refundPoint),
                'pointFees'=> number_format($pointFees),
            ];


            return $this->response->setJSON($refund34Point);
        }
    }
}