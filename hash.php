<?php
echo "使用手册：php pass.php ./pass.txt ./pass_hash.txt \n";
$v1 = $argv[1];
$v2 = $argv[2];
if(isset($v1) && isset($v2)){
    echo "[+] start ...\n";
    $passfile = fopen($v1, 'rb+');
    if(!$passfile){
        echo "[-] open passfile is error.";
        exit();
    }else{
        while (!feof($passfile)) {
            $pass = fgets($passfile);
            $hashfile = fopen($v2, 'rb+');
            if(isset($hashfile)){
                if(!$hashfile){
                    echo "[-] open hashfile is error.\n";
                    exit();
                }else{
                    while(!feof($hashfile)){
                        $hashline = fgets($hashfile);
                        if(password_verify(trim($pass), trim($hashline))){
                            echo trim($pass)." - ".trim($hashline)."\n";
//                             break 2;
                        }
                    }
                }
            }else{
                echo "[-] please input hashfile_path.\n";
                exit();
            }
        }
        fclose($passfile); 
        fclose($hashfile);
    }
}else{
    echo "[-] please input passfile_path.\n";
}

