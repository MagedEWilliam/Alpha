<?php
function mySqlErrors($response)
{
    //Returns custom error messages instead of MySQL errors
    switch (substr($response, 0, 22)) {

        case 'Error: SQLSTATE[23000]':
            echo "<div class=\"ui icon error visible message\">
                  <i class=\"info icon \"></i>
                  <i class=\"ui icon close\"></i>
                  <div class=\"content\">
                    <div class=\"header\">   
                    </div>
                    <p>Username or email already exists</p>
                </div>
            </div>
            ";
            break;

        default:
            echo "
            <div class=\"ui icon error visible message\">
                  <i class=\"bug icon \"></i>
                  <i class=\"ui icon close\"></i>
                  <div class=\"content\">
                    <div class=\"header\">  
                    An error occurred
                    </div>
                    <p>try again</p>
                </div>
            </div>
            ";

    }
}
