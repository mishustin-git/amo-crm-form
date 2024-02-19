<?php
    class Lead {
        private $name, $email, $phone, $cost, $hidden, $amo_api_link, $amo_access_token;
        public function __construct($name = null, $email = null, $phone = null, $cost = null, $hidden = null,$link = null, $token=null){
            $this->$name = $name;
            $this->$email = $email;
            $this->$phone = $phone;
            $this->$cost = $cost;
            $this->$hidden = $hidden;
        }
        public function setName($name){
            $this->name = $name;
		}
        public function getName(){
            return $this->name;
		}
        public function setEmail($email){
            $this->email = $email;
		}
        public function getEmail(){
            return $this->email;
		}
        public function setPhone($phone){
            $this->phone = $phone;
		}
        public function getPhone(){
            return $this->phone;
		}
        public function setCost($cost){
            $this->cost = (int)$cost;
		}
        public function getCost(){
            return $this->cost;
		}
        public function setHidden($hidden){
            $time_mass = explode(":", $hidden);
            $time_seconds = $time_mass[0]*60 + $time_mass[1];
            if ($time_seconds > 30){
                $this->hidden = true;
            }
            else{
                $this->hidden = false;
            }
		}
        public function getHidden(){
            return $this->hidden;
		}
        public function setLink($link){
            $this->link = $link;
		}
        public function setToken($token){
            $this->token = $token;
		}

        public function createAmoLead(){
            $headers = [
                'Authorization: Bearer ' . $this->token
            ];
            $arrTaskParams = [
                [
                    'name' => 'Заявка с формы время - ' . date("Y-m-d H:i:s"), 
                    'price' => $this->cost, 
                    "_embedded" => [
                        "contacts" => [
                            [
                                "first_name" => $this->name,
                                "custom_fields_values" => [
                                    [
                                        "field_code" => "EMAIL",
                                        "values" => [
                                            [
                                                "enum_code" => "WORK",
                                                "value" => $this->email
                                            ]
                                        ]
                                    ],
                                    [
                                        "field_code" => "PHONE",
                                        "values" => [
                                            [
                                                "enum_code" => "WORK",
                                                "value" => $this->phone
                                            ]
                                        ]
                                    ],
                                    [
                                        "field_id"=>390259,
                                        "values"=>[
                                           [
                                              "value"=>$this->hidden
                                           ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ],
                ], 
            ];  
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_USERAGENT, "amoCRM-API-client-undefined/2.0");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($arrTaskParams));
            curl_setopt($curl, CURLOPT_URL, $this->link);
            curl_setopt($curl, CURLOPT_HEADER,false);
            curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__)."/cookie.txt");
            curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__)."/cookie.txt");
            $out = curl_exec($curl); //Инициируем запрос к API и сохраняем ответ в переменную
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            /** Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
            $code = (int)$code;
            $errors = [
                400 => 'Bad request',
                401 => 'Unauthorized',
                403 => 'Forbidden',
                404 => 'Not found',
                500 => 'Internal server error',
                502 => 'Bad gateway',
                503 => 'Service unavailable',
            ];
            
            // try
            // {
            //     print_r($out);
            //     /** Если код ответа не успешный - возвращаем сообщение об ошибке  */
            //     if ($code < 200 || $code > 204) {
            //         throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
            //     }
            // }
            // catch(\Exception $e)
            // {
            //     die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
            // }
            if ($code < 200 || $code > 204){
                echo '<script type="text/javascript">';
                echo 'window.location.href="https://mishustin.space?error=1";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url=https://mishustin.space?error=1" />';
                echo '</noscript>'; exit;
            }
            else{
                echo '<script type="text/javascript">';
                echo 'window.location.href="https://mishustin.space?error=0";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url=https://mishustin.space?error=0" />';
                echo '</noscript>'; exit;
            }
        }
    };
?>