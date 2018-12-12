<?php
    $id = intval($_GET['code']);
    $charity = intval($_GET['charity']);

    if (strlen($id)>=6 && strlen($id)<=6) {

        function json_response($code = null, $data = null) {
            header_remove();
            header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
            header('Content-type: application/json');

            return json_encode(array(
                'code' => $code,
                'data' => $data
            ));
        }

        $config = parse_ini_file('db.ini');

        $servername = $config['servername'];
        $username = $config['username'];
        $password = $config['password'];
        $db = $config['db'];

        $link = mysqli_connect($servername, $username, $password, $db);

        $sql = "SELECT * FROM `app_people_list` WHERE `code` = $id";
        $result = mysqli_query( $link, $sql ); 
        $row = mysqli_fetch_array( $result );

        if ($row['voted'] == "false") {
            $addvote = "UPDATE app_chooses_list SET votes=votes+1 WHERE id = $charity";
            $resultaddvote = mysqli_query( $link, $addvote ); 

            if ($resultaddvote == true) {
                $updatevoted = "UPDATE app_people_list SET voted='true' WHERE code = $id";
                $resultvoted = mysqli_query( $link, $updatevoted ); 
                if ($resultvoted == true) {
                    echo json_response(200, 'succes');
                } else {
                    echo json_response(422, 'voted not changed'); 
                }
            } else {
                echo json_response(422, 'vote not added');
            }
        } else {
            echo json_response(422, 'code already used'); 
        }

        mysqli_close($link);
        
    }
