<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <form action="process.php" method="post" id="myform" class="form-horizontal">
                            <fieldset>

                                <div class="control-group">
                                    <label class="control-label" for="input01"> First Name </label>
                                    <div class="controls">
                                        <input type="text" name="fname" class="input-xlarge" id="input01">

                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">Last Name</label>
                                    <div class="controls">
                                        <input type="text" name="lname" class="input-xlarge" id="input01">

                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="input01"> Email </label>
                                    <div class="controls">
                                        <input type="text" name="email" class="input-xlarge" id="input01">

                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label class="control-label" for="input01"> Password </label>
                                    <div class="controls">
                                        <input type="text" name="password" class="input-xlarge" id="input01">

                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label class="control-label" for="input01"> Mobile Number </label>
                                    <div class="controls">
                                        <input type="text" name="mobile" class="input-xlarge" id="input01">

                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">Gender</label>
                                    <div class="controls">
                                        
                                        <select class="input-xlarge" id="input01" name="gender">
                                            <option>MALE</option>
                                            <option>FEMALE</option>
                                        </select>
                                    </div>
                                </div>
                                
                                 <div class="control-group">
                                    <label class="control-label" for="optionsCheckbox">Product ID</label>
                                    <div class="controls">
                                        
                                        <input type="text" class="input-xlarge" id="input01" name="pid">
                                            
                                    </div>
                                    <label>Branch Visited</label>
                                    <p> <input type="text" name="branch" /></p>
                                   <label>Name Of Employee</label>
                                    <p> <input type="text" name="emp" /></p>
                                    <label>Complaint</label>
                                    <p> <textarea name="comp"></textarea></p>
                                </div>
                            </fieldset>

                            </p>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" value="Submit" name="compliant"  class="btn btn-primary"/>
                    </div>
                    </form>
    </body>
</html>
