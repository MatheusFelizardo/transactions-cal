<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://cdn.tailwindcss.com"></script>

  <title>My Transactions Application</title>
</head>
<body>
  <div class="container p-10 max-w-4xl">
    <h1 class="text-4xl">My Transactions</h1>

    <div class="container max-h-[26rem] 	overflow-auto mt-8 ">
      <div class="grid grid-cols-4 font-semibold bg-green-500 p-1 text-white text-sm uppercase z-10 sticky top-0">
        <span>Date</span>
        <span>Check</span>
        <span>Description</span>
        <span>Amount</span>
      </div>  

      <div class="container">
        <?php foreach ($transactions as $transaction): ?>
          <div class="grid grid-cols-4 mt-1 font-semibold bg-green-100 p-1 text-xs text-black-500 justify-center items-center">
            <span><?= $transaction['date'] ?></span>
            <span><?= $transaction['check'] ?></span>
            <span><?= $transaction['description'] ?></span>
            <span class="relative font-bold <?= (getFormattedAmount($transaction['amount']) > 0) ? 'text-green-600' : 'text-red-600' ?>"><?= parseValue($transaction['amount']) ?></span>
          </div>  
        <?php endforeach ?>
      </div>
    </div>

    <div class="container mt-4">
        <div class="grid grid-cols-4 mt-1 font-semibold bg-orange-100 p-1 text-xs text-black-500 justify-center items-center">
          <span class="font-semibold">Total Income</span>
          <span></span>
          <span></span>
          <span class="relative font-bold <?= getFormattedAmount($totalValues['income']) >= 0 ? 'text-green-600' : 'text-black' ?>">
            <?= parseValue($totalValues['income']) ?>
          </span>
        </div>  
        <div class="grid grid-cols-4 mt-1 font-semibold bg-orange-100 p-1 text-xs text-black-500 justify-center items-center">
          <span class="font-semibold">Total Expense</span>
          <span></span>
          <span></span>
          <span class="relative font-bold <?= getFormattedAmount($totalValues['outcome']) < 0 ? 'text-red-600' : 'text-black' ?>">
            <?= parseValue($totalValues['outcome']) ?>
          </span>
        </div>  
        <div class="grid grid-cols-4 mt-1 font-semibold bg-orange-100 p-1 text-xs text-black-500 justify-center items-center">
          <span class="font-semibold">Total</span>
          <span></span>
          <span></span>
          <span class="relative font-bold <?= getFormattedAmount($totalValues['total']) == 0 ? 'text-black' : (getFormattedAmount($totalValues['total']) > 0 ? 'text-green-600' : 'text-red-600') ?>">
            <?= parseValue($totalValues['total']); ?>
          </span>
        </div>  
      </div>
  </div>
</body>
</html>