<?php
$client = curl_init('Our API.com/apiHandler.php?action=outputData') # The URL of our API is not defined
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($client);
$result = json_decode($response);

$output = '';

if(count($result) > 0) {
    foreach($result as $row) {
        $output .= '
            <tr>
                <td>'.$row->id.'</td>
                <td>'.$row->to_do.'</td>
                <td>'.$row->date.'</td>
            </tr>
        ';
    }
} else {
    $output .= '<tr><td colspan = "3" align = "Center">Not found</td></tr>'
}
?>