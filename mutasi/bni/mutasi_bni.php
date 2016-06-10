<?php

function mutasi_bni($username, $password, $nomor_rekening, $jangka_waktu = 7, $cek_saldo = false)
{
    $ua = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.75 Safari/537.36";
    $cookie = dirname(__file__) . '/bni-cookie.txt';
    $payload = array();

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_URL,
        'https://ibank.bni.co.id/MBAWeb/FMB;jsessionid=0000gsadMFnW4TJnYCFiblgmvcx:1a1li5jho?page=Thin_SignOnRetRq.xml&MBLocale=bh');
    $result = curl_exec($ch);

    preg_match('/\<form(.*?)action\=\"(.*?)\"/i', $result, $matches);
    $url = $matches[2];

    $postdata = 'Num_Field_Err=%22Please+enter+digits+only%21%22&Mand_Field_Err=%22Mandatory+field+is+empty%21%22&CorpId=' .
        urlencode($username) . '&PassWord=' . urlencode($password) .
        '&__AUTHENTICATE__=Login&CancelPage=HomePage.xml&USER_TYPE=1&MBLocale=bh&language=bh&AUTHENTICATION_REQUEST=True&__JS_ENCRYPT_KEY__=&JavaScriptEnabled=N&deviceID=&machineFingerPrint=&deviceType=&browserType=&uniqueURLStatus=disabled&imc_service_page=SignOnRetRq&Alignment=LEFT&page=SignOnRetRq&locale=en&PageName=Thin_SignOnRetRq.xml&formAction=https%3A%2F%2Fibank.bni.co.id%2FMBAWeb%2FFMB%3Bjsessionid%3D0000gsadMFnW4TJnYCFiblgmvcx%3A1a1li5jho&mConnectUrl=FMB&serviceType=Dynamic';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_POST, 1);
    file_put_contents('mutasi.bni.txt', $result = curl_exec($ch));

    preg_match('/\<a id\=\"MBMenuList\"(.*?)href\=\"(.*?)\"/i', $result, $matches);
    if (!$matches) {
        $payload['status'] = 'error';
        $payload['error_message'] = 'Gagal masuk';
        return $payload;
    }
    $payload['status'] = 'success';
    parse_str($matches[2], $params);

    $jkt_time = time();
    $dari_tgl = date('d-M-Y', $jkt_time - (3600 * (24 * $jangka_waktu)));
    $ke_tgl = date('d-M-Y', $jkt_time);

    $postdata = 'Num_Field_Err=%22Please+enter+digits+only%21%22&Mand_Field_Err=%22Mandatory+field+is+empty%21%22&acc1=OPR%7C0000000' .
        $nomor_rekening . '%7CBNI+TAPLUS&TxnPeriod=-1&Search_Option=Date&txnSrcFromDate=' .
        $dari_tgl . '&txnSrcToDate=' . $ke_tgl .
        '&FullStmtInqRq=Lanjut&MAIN_ACCOUNT_TYPE=OPR&mbparam=' . urlencode($params['mbparam']) .
        '&uniqueURLStatus=disabled&imc_service_page=AccountIDSelectRq&Alignment=LEFT&page=AccountIDSelectRq&locale=bh&PageName=AccountTypeSelectRq&formAction=' .
        urlencode($url) . '&mConnectUrl=FMB&serviceType=Dynamic';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    $data_mutasi = curl_exec($ch);

    if (stripos($data_mutasi, 'ditentukan dan tanggal yang valid') !== false) {
        $dari_tgl = date('d-m-Y', $jkt_time - (3600 * (24 * $jangka_waktu)));
        $ke_tgl = date('d-m-Y', $jkt_time);
        $postdata = 'Num_Field_Err=%22Please+enter+digits+only%21%22&Mand_Field_Err=%22Mandatory+field+is+empty%21%22&acc1=OPR%7C0000000' .
            $nomor_rekening . '%7CBNI+TAPLUS&TxnPeriod=-1&Search_Option=Date&txnSrcFromDate=' .
            $dari_tgl . '&txnSrcToDate=' . $ke_tgl .
            '&FullStmtInqRq=Lanjut&MAIN_ACCOUNT_TYPE=OPR&mbparam=' . urlencode($params['mbparam']) .
            '&uniqueURLStatus=disabled&imc_service_page=AccountIDSelectRq&Alignment=LEFT&page=AccountIDSelectRq&locale=bh&PageName=AccountTypeSelectRq&formAction=' .
            urlencode($url) . '&mConnectUrl=FMB&serviceType=Dynamic';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        $data_mutasi = curl_exec($ch);

    }
    if ($cek_saldo) {
        $postdata = 'Num_Field_Err=%22Please+enter+digits+only%21%22&Mand_Field_Err=%22Mandatory+field+is+empty%21%22&acc1=OPR%7C0000000' .
            $nomor_rekening . '%7CBNI+TAPLUS&BalInqRq=Lanjut&MAIN_ACCOUNT_TYPE=OPR&mbparam=' .
            urlencode($params['mbparam']) .
            '&uniqueURLStatus=disabled&imc_service_page=AccountIDSelectRq&Alignment=LEFT&page=AccountIDSelectRq&locale=bh&PageName=AccountTypeSelectRq&formAction=' .
            urlencode($url) . '&mConnectUrl=FMB&serviceType=Dynamic';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        $data_saldo = curl_exec($ch);

        preg_match_all('/\<span(.*?)class\=\"BodytextUnbold\"\>(.*?)\<\/span\>/i', $data_saldo,
            $matches);
        if ($matches && isset($matches[2][3])) {
            $payload['saldo'] = (int)str_replace('.', '', substr($matches[2][3], 0, -3));
        }
        else {
            $payload['saldo'] = null;
        }
    }
    $postdata = 'Num_Field_Err=%22Please+enter+digits+only%21%22&Mand_Field_Err=%22Mandatory+field+is+empty%21%22&__LOGOUT__=Keluar&mbparam=' .
        urlencode($params['mbparam']) .
        '&uniqueURLStatus=disabled&imc_service_page=SignOffUrlRq&Alignment=LEFT&page=SignOffUrlRq&locale=bh&PageName=LoginRs&formAction=' .
        urlencode($url) . '&mConnectUrl=FMB&serviceType=Dynamic';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    $result = curl_exec($ch);
    curl_close($ch);

    preg_match_all('/\<span id\=\"H\"(.*?)\>(.*?)\<\/span\>/i', $data_mutasi, $matches);
    if (!$matches || !isset($matches[2]) || count($matches[2]) <= 5) {
        $payload['trx'] = array();
        return $payload;
    }
    $histories_tmp = array();
    $histories = array();
    for ($i = 2; $i < count($matches[2]) - 1; $i++) {
        if (trim($matches[2][$i]) == '')
            continue;
        $histories_tmp[] = trim($matches[2][$i]);
    }
    foreach (array_chunk($histories_tmp, 5) as $history) {
        $jumlah = (int)str_replace('.', '', substr($history[3], 4, -3));
        $histories[] = array(
            'tanggal' => date('Y-m-d', strtotime($history[0])),
            'keterangan' => $history[1],
            'debet' => ($history[2] == 'Db' ? $jumlah : 0),
            'kredit' => ($history[2] == 'Cr' ? $jumlah : 0),
            );
    }
    $payload['trx'] = $histories;
    return $payload;
}
