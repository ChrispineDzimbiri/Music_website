<?php require page('includes/header')?>

<div>
  <form action="https://api.web3forms.com/submit" method="POST" style="max-width: 500px; margin: auto;">
    
    <div>
      <input type="hidden" name="access_key" value="d9358472-693c-4fdb-9a31-04bc6820ef91">
      <input class="form-control my-1"type="text" name="name" placeholder="Your name" required>
      <input class="form-control my-1"type="text" name="email" placeholder="Your email" required>
      <textarea class="form-control my-1"name="message" placeholder="Your message"></textarea>
      <button type="submit" style="display: flex; border-radius: 50px; background:linear-gradient(270deg, #ff994f, #fa6d86);border:none; padding: 15px 30px; margin-bottom: 10px; cursor:pointer; color: white">Submit</button>
    </div>
  </form>
</div>
<?php require page('includes/footer')?>
