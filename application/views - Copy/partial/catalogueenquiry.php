<section class="corporate-gifts">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
  <div class="reach-us p-4">
    <h4>Contact Us</h4>
    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In ornare tincidunt lacus, </p>
    <div class="cont-frm">
      <form name="productEnquiry" method="post" action="#" id="productEnquiry">
        <div class="frm-fields clearfix">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="form-data">
                <input type="text" placeholder="Name" id="firstname" name="firstname" class="form-control mb-5 p-3 required" required >
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-data">
                <input type="email" placeholder="Email" id="emailid" name="emailid" class="form-control mb-5 p-3 jsrequired" required >
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-data">
                <input type="text" placeholder="Contact Number" id="contactno" name="contactno" onKeyPress="return CheckNumericKeyInfo(event.keyCode, event.which)"; maxlength="13" minlength="10"  class="form-control mb-5 p-3 jsrequired" required>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-data">
                <input type="text" placeholder="Company" id="companyname" name="companyname" class="form-control mb-5 p-3 jsrequired" required >
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-data select-dd">
                <select name="purchasereasonid" id="purchasereasonid" class="form-control select2" required>
                  <option value="">--Reason For Purchase--</option>
                  <option value="1">Bulk Upload</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-data select-dd">
                <select name="typeofbusinessid" id="typeofbusinessid" class="form-control select2" required>
                  <option value="">--Type Of Business--</option>
                  <option value="1">Corporate</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-data select-dd">
                <select name="countryid" id="countryid" class="form-control select2" required>
                  <option value="">--Country--</option>
                  <option value="1">India</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-data select-dd">
                <select name="purchasebefore" id="purchasebefore" class="form-control select2" required>
                  <option value="">--Purchased before--</option>
                  <option value="1">Yes</option>
                  <option value="2">No</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-data">
                <input type="text" class="form-control mb-5 p-3" placeholder="Delivery Date" id="deliverydate" name="deliverydate" required>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="form-data select-dd">
                <select name="paymentmethodid" id="paymentmethodid" class="form-control select2" required>
                  <option value="">--Payment Method--</option>
                  <option value="1">COD</option>
                  <option value="2">NET</option>
                </select>
              </div>
            </div>
            <div class="col-sm-12 col-md-12">
              <div class="form-data">
                <textarea class="form-control mb-4 p-3" id="additionalmsg" placeholder="Additional information" name="additionalmsg" required></textarea>
              </div>
            </div>
          </div>
          <div class="form-data">
            <input type="button" class="common-btn" name="submit" id="submit" value="Send Message" onClick="generateCatalogue('productEnquiry','<?php echo BASE_URL; ?>ajax/productcatalogueEnquiry','<?php echo BASE_URL;?>contactus');">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</section>