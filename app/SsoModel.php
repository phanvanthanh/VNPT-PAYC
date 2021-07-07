<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use DateTime;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class SsoModel extends Model
{
    
    public static function ssoDangNhap($username, $password){
        // Gọi api gửi tin nhắn qua Telegram
        $client = new Client();
        
        $body=json_encode(array(
            'user_name'      =>$username,
            'password'       =>$password
        ));        
        
        $decodeBody= array();


        try {
            $r = $client->request('POST', 'https://api.vnpttravinh.vn/xac-thuc/dang-nhap', [
                'headers'   =>[
                    'Content-Type'      =>'application/json'
                ],
                'body'   =>$body
            ]);

            if ($r->getStatusCode()==201) {
                $result=json_decode($r->getBody(), true);
                if(!$result){ // Có trường hợp status thành công mà body thì bị rỗng. VD: bỏ headers
                    $decodeBody= array(
                        'message'           => 'Dữ liệu rổng',
                        'errors'            => 100,
                        'expires_at'        => date('Y-m-d H:i:s'),
                        'data'              => null
                    );
                }else{
                    $decodeBody= array(
                        'message'           => 'Lấy dữ liệu thành công',
                        'errors'            => 0,
                        'expires_at'        => date('Y-m-d H:i:s'),
                        'data'              => $result
                    );
                }
            }else{
                $decodeBody= array(
                    'message'           => 'Lấy dữ liệu thất bại',
                    'errors'            => 101,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => null
                );
            }


        } catch (RequestException $e) {
            // echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                // echo Psr7\str($e->getResponse());
                $decodeBody= array(
                    'message'           => 'Tên đăng nhập hoặc mật khẩu không đúng',
                    'errors'            => 401,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => null
                );
            
            }
        }
        

        // Để ghi log
        $sendBody=array(
            'method'    =>'POST',
            'url'       =>'https://api.vnpttravinh.vn/xac-thuc/dang-nhap',
            'headers'   =>[
                    'Content-Type'      =>'application/json'
                ],
                'raw'   =>[
                    'user_name'      =>$username,
                    'password'       =>$password
                ]

        );
        $dataLog=array();
        $dataLog['send_body']=json_encode($sendBody,JSON_UNESCAPED_UNICODE);
        $dataLog['respone_body']=json_encode($decodeBody,JSON_UNESCAPED_UNICODE);
        $dataLog['user_id']=null;
        BcLogDhsxkd::create($dataLog);
        // End ghi log

        return $decodeBody;
    }

    public static function ssolayIdNhanVien($accessToken){
        // Gọi api gửi tin nhắn qua Telegram
        $client = new Client();
        $r = $client->request('GET', 'https://api.vnpttravinh.vn/xac-thuc/lay-id', [
                'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'x-access-token'      =>$accessToken
                ]
            ]);
        $decodeBody=array();
        if ($r->getStatusCode()==201) {
            $result=json_decode($r->getBody(), true);
            if(!$result){ // Có trường hợp status thành công mà body thì bị rỗng. VD: bỏ headers
                $decodeBody= array(
                    'message'           => 'Dữ liệu rổng',
                    'errors'            => 100,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => null
                );
            }else{
                $decodeBody= array(
                    'message'           => 'Lấy dữ liệu thành công',
                    'errors'            => 0,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => $result
                );
            }
        }else{
            $decodeBody= array(
                'message'           => 'Lấy dữ liệu thất bại',
                'errors'            => 101,
                'expires_at'        => date('Y-m-d H:i:s'),
                'data'              => null
            );
        }

        // Để ghi log
        $sendBody=array(
            'method'    =>'GET',
            'url'       =>'https://api.vnpttravinh.vn/xac-thuc/lay-id',
            'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'x-access-token'      =>$accessToken
                ]

        );
        $dataLog=array();
        $dataLog['send_body']=json_encode($sendBody,JSON_UNESCAPED_UNICODE);
        $dataLog['respone_body']=json_encode($decodeBody,JSON_UNESCAPED_UNICODE);
        $dataLog['user_id']=null;
        BcLogDhsxkd::create($dataLog);
        // End ghi log


        return $decodeBody;
    }
    
}
