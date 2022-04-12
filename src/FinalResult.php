<?php

class FinalResult {
    function csvToBankHash($csvFile) {
        $data = fopen($csvFile, "r");
        $error_handler = fgetcsv($data);
        $records = [];
        while(!feof($data)) {
            $row = fgetcsv($data);
            if(count($row) == 16) {
                $amount = !$row[8] || $row[8] == "0" ? 0 : (float) $row[8];
        $bank_account_number = (int) $row[6] ?: "Bank account number missing";
        $bank_branch_code = $row[2] ?: "Bank branch code missing";
        $end_to_end = !$row[10] && !$row[11] ? "End to end id missing" : $row[10] . $row[11];
        $record = [
            "amount" => [
                "currency" => $error_handler[0],
                "subunits" => (int) ($amount * 100)
            ],
            "bank_account_name" => str_replace(" ", "_", strtolower($row[7])),
            "bank_account_number" => $bank_account_number,
            "bank_branch_code" => $bank_branch_code,
            "bank_code" => $row[0],
            "end_to_end_id" => $end_to_end,
        ];
            $records[] = $record;
            }
        }
        $rcs = array_filter($records);
        return [
            "filename" => basename($csvFile),
            "document" => $data,
            "failure_code" => $error_handler[1],
            "failure_message" => $error_handler[2],
            "records" => $records
        ];
    }
}
?>
