<div class="container clearfix">
    
    <!-- Page Title --	>
    <!-- Start Project Slider -->
    <div class="ten columns top bottom">
        <div class="slider-project">
            <div class="flex-container">
            
            <h2 class="title">Make a Reservation</h2>
            <form action="" method="post" class="form-elements">
            
              <fieldset>
                <label>Room Type:</label>
                <select name="rmtype">
                  <option value=1>Standard King - N30000</option>
                </select>
              </fieldset>

               <fieldset>
                <label>Arrival Date:</label>
                <input type="text" value="" name="arrival" placeholder="yyyy-mm-dd">
              </fieldset>
              
              <fieldset>
                <label>No of nights:</label>
                <select name="nights" style="width:80px;">
                  <option value="1">1</option>
                </select>
              </fieldset>
              
               <fieldset>
                <label>Adults:</label>
                <select name="adult" style="width:80px;">
                  <option value="1">1</option>
                </select>
              </fieldset>
              
               <fieldset>
                <label>Children:</label>
                <select name="child" style="width:80px;">
                  <option value="1">1</option>
                </select>
              </fieldset>
              
           <div class="clear"></div>
           <div class="right">
           <input type="submit" name="reservenow" class="button small color" value="Reserve Now!">
           </div>
           </form>

                
                
                
            </div>
        </div>
        <!-- End slider-project -->
    </div>
    <!-- End -->
    
    
    <!-- Start Project Details -->
    <div class="six columns  bottom">
        <!--<h2 class="title top-5  bottom-2">
            Project Details</h2> -->
        <div class="about-project bottom">
          <p><?php echo $rmrow['descr'];  ?></p>
        </div>        
        
        <h2 class="title bottom-2">
            For More Info
        </h2>        
        
       
       
       
       
       
       
    </div>
    <!-- End Project Details -->
    <div class="clearfix"></div>
   
</div>