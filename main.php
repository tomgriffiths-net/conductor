<?php
class conductor{
    public static function command($line):void{
        $lines = explode(" ",$line);
        if($lines[0] === "begin"){
            if(class_exists("conductor_server")){
                conductor_server::start();
            }
        }
        elseif($lines[0] === "connect"){
            if(class_exists("conductor_client")){
                if(isset($lines[1])){
                    conductor_client::repeat($lines[1]);
                }
                else{
                    echo "IP not specified\n";
                }
            }
        }
        elseif($lines[0] === "add"){
            if(class_exists("conductor_client")){
                if(isset($lines[1])){
                    if(isset($lines[2])){
                        $port = 52000;
                        $finishFunction = false;
                        if(isset($lines[3])){
                            $port = intval($lines[3]);
                        }
                        if(isset($lines[4])){
                            $finishFunction = $lines[4];
                        }
                        conductor_client::addJob($lines[1],$lines[2],$port,$finishFunction);
                    }
                    else{
                        echo "Function not specified\n";
                    }
                }
                else{
                    echo "IP not specified\n";
                }
            }
        }
        elseif($lines[0] === "stop"){
            if(class_exists("conductor_client")){
                if(isset($lines[1])){
                    conductor_client::run($lines[1],array("type"=>"stop","payload"=>""));
                }
                else{
                    echo "IP not specified\n";
                }
            }
        }
    }
}