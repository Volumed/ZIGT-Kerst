<?php
    $id = $_GET['code'];

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

        if ($link) {

            $sql = "SELECT * FROM `app_list_people` WHERE code = $id";
            $result = mysqli_query( $link, $sql ); 
            $row = mysqli_fetch_array( $result );

            if($row) {
                echo json_response(200, array_splice($row, 2, 6));
            } else {
                echo json_response(404, 'no record found');
            }
        
        } else {
            echo json_response(500, 'no mysql connection');
        }

        mysqli_close($link);
        
    }
