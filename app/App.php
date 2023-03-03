<?php


function getAllTransactions($callback = null) {
  $files = scandir(FILES_PATH);
  $transactions = [];

  foreach ($files as $_file) {
    $filePath = FILES_PATH . $_file;
      
    if (is_file($filePath)) {
      $file = fopen($filePath, 'r');
      fgetcsv($file); // Used to ignore first line

      while (($line = fgetcsv($file)) !== false){
        $transactions[] = $line;
      }
      
      fclose($file);
    }
  }

  // Callback to accept any function that need the transactions
  // So if you want to get the just the values you should use $transactions = getAllTransactions();
  // If you want to use the function to get the total values, for example, you should use the callback as parameter
  // $totalValues = getAllTransactions('getIncomeAndOutcome');

  if (isset($callback)) {
    if (!function_exists($callback)) {
      throw new Exception("This function ($callback) doesn't exists");
    }

    return $callback(sanitizeTransactions($transactions));
  }

  return sanitizeTransactions($transactions);
}

function sanitizeTransactions($transactions) {

  $parsedTransactions = [];

  foreach ($transactions as $transaction) {
    $formated = [
      'date' => $transaction[0],
      'check' => $transaction[1],
      'description' => $transaction[2],
      'amount' => $transaction[3]
    ];
    
    $parsedTransactions[] = $formated;
  }
  return $parsedTransactions;
}

function getIncomeAndOutcome($transactions) {
  $values = ['income' => 0, 'outcome' => 0, 'total' => 0];

  foreach ($transactions as $transaction) {
    $formatedAmount = getFormattedAmount($transaction['amount']);
    
    if ($formatedAmount > 0) {
      $values['income'] += $formatedAmount;
    } else {
      $values['outcome'] += $formatedAmount;
    }
  }
    
  $values['total'] = $values['income'] + $values['outcome']; // outcome is a negative value
  return $values;
}

