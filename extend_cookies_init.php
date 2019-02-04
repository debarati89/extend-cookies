<?php
ob_start();
function cookies_init(){?>
<div style="margin-top:45px"></div>

<div class="container">
  <h3>Cookies available in browser for this site.</h3><br><br>
  <table class="table table-responsive table-bordered">
    <thead>
      <tr>
        <th>Cookie Name</th>
        <th>Cookie Value</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($_COOKIE as $key => $value):?>
      <tr>
        <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;"><?php echo $key;?></td>
        <td style="word-wrap: break-word;min-width: 160px;max-width: 160px;"><?php echo $value;?></td>
      </tr>
      
    
  <?php endforeach;?>
  </tbody>
  </table>
  <input type="submit" id="submit" value="Set Cookie expiry time as 24hrs" class="btn btn-primary">
  <div class="alert alert-success" style="display: none;margin-top: 5px;">
      <p id="success" class="success"></p>
  </div>
</div>
<script type="text/javascript">
  jQuery(document).ready(function(){

    var expDate = new Date();
    expDate.setTime(expDate.getTime() + (1 * 60 * 1000)); // add 1 minute
    //alert(expDate);


     jQuery("#submit").click(function(){

      confirm("This will set all the cookies to expire in next 24 hrs. Are you sure ?");
      //jQuery.cookie('visits', '3', { expires: expDate });
        jQuery.each(document.cookie.split(/; */), function()  {
        var splitCookie = this.split('=');
        var cookieName = splitCookie[0];
        var cookieVal = splitCookie[1];

        $.cookie(cookieName, cookieVal, { expires: expDate });
        //alert(cookieName+' expiry time has been set');

        });

        jQuery("#success").html("Expiry time has been set for all cookies");
        jQuery(".alert").show();

     });

  });
</script>
<?php 


}