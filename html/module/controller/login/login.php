<?php
$DINO=date('Y-m-d H:i:s');
if(isset($_POST["login"]))
    {
        $KODE_USER = $_POST["username"];
        $PASSWORD  = $_POST['password'];
        $result    = $db1->prepare("select * from m_user where KODE_USER = '$KODE_USER'"); 
	    $result->execute();
        if($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            $PASS       = $row["PASSWORD"];
            $STATUS     = $row["STATUS"];
            $STS_LGN    = $row["STS_LGN"];
            $IP_ADDRESS = getIp();
            $PC_NAME    = gethostbyaddr($IP_ADDRESS);

            if ($STATUS == "Aktif" and password_verify($PASSWORD, $PASS)) 
            { 
                $_SESSION["IP_ADDRESS_SPEC_BB"]    = $IP_ADDRESS;
                $_SESSION["PC_NAME_SPEC_BB"]       = $PC_NAME;
                $_SESSION["LOGINIDUS_SPEC_BB"]     = $row["KODE_USER"];
                $_SESSION["LOGINNAMAUS_SPEC_BB"]   = $row["NAMA_USER"];
                $_SESSION["LOGINAKS_SPEC_BB"]      = $row["AKSES"];
                $_SESSION["LOGINAUTH_SPEC_BB"]     = $row["AKSES"];
                $_SESSION["LOGINPER_SPEC_BB"]      = $row["KODE_PERUSAHAAN"];
                $_SESSION["LOGINNOM_SPEC_BB"]      = $row["NOMOR"];
                $_SESSION["LOGINAKSDOC_SPEC_BB"]   = $row["AKSES_DOC"];
                

                $result1 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('" . $row["KODE_USER"] . "','$IP_ADDRESS','$PC_NAME','$DINO','Login','Masuk','Akses =" . $row["AKSES"] . "')"); 
	            $result1->execute();

                $result2 = $db1->prepare("update m_user set STS_LGN = '1' where KODE_USER = '" . $_SESSION["LOGINIDUS_SPEC_BB"] ."'"); 
	            $result2->execute();

                ?><script>document.location.href='menuutama.php';</script><?php
                die(0);

            }
            else 
            { 
                $result1 = $db1->prepare("insert into t_userlog (KODE_USER,IP_ADDRESS,PC_NAME,TANGGAL,MODUL,JENIS_LOG,AKTIVITAS) values ('" . $row["KODE_USER"] . "','$IP_ADDRESS','$PC_NAME','$DINO','Login','Masuk','Gagal Login Akses =" . $row["AKSES"] . "')"); 
	            $result1->execute();

                ?><script>alert('Username atau password salah');</script><?php
                ?><script>document.location.href='index.php';</script><?php
                die(0);

            } 
        }
    }
    ?>