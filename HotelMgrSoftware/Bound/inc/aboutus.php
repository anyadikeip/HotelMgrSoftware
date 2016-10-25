<div class="container clearfix">
<div class="sixteen columns">
  <h1 class="page-title"> About Us
    <div class="frightimp">
      <form action="#" method="" class="form-elements">
        <input type="text">
        <a href="#" class="button small gray pagesearch">Search</a>
      </form>
    </div>
  </h1>
</div>


<div class="sixteen columns clearfix">
  
  
  <div class="two-thirds column alpha">
    <p class="MB20"> 
    <?php echo $hotel_desc; ?>
    </p>
  </div>
  
  
  <div class="one-third column omega">
    <div class="bottom">
    
      <div id="horizontal-tabs">          
        <ul class="tabs">
          <li id="tab1">Hotel Facilities</li>
        </ul>            
        
        <div class="contents">
          <div id="content1" class="tabscontent">
            <ul class="check-list">
                <?php 
                $qryam=mysql_query("SELECT * FROM amenities WHERE
                type=1 AND status=0") or die(mysql_error());
                while($arw=mysql_fetch_array($qryam)){	
                ?>
              <li>
                <?php echo $arw['name']; ?>
              </li>                  
              <?php } ?>
            </ul>
          </div>
         
         </div>
      </div>
      
    </div>
  </div>
  <!-- End skills --> 
  
</div>

<div class="clearfix"></div>


</div>
<!-- <<< End Container >>> --> 