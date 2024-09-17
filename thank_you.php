<?php 
require('top.php');
?>

      
<div class="thank-you-message">
    <h1>Hvala na vašoj kupovini</h1>
    <p>Vaša porudžbina je uspješno primljena</p>
    <a href="index.php" class="button">Vrati se na početnu</a>
  </div>
  
  
   <style>
 

    .thank-you-message {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 60vh;
      text-align: center;
      padding: 20px;
    }

    h1 {
      font-size: 2rem;
      margin-bottom: 10px;
    }

    p {
      font-size: 1.1rem;
      margin-top: 10px;
      color: #666;
    }

    .button {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      font-size: 1rem;
      transition: background-color 0.3s ease;
    }

    .button:hover {
      background-color: #555;
    }
  </style>
        						
     