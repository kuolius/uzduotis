
        <?php echo form_open('Account/register',array('class'=>'form-horizontal','id'=>'signupForm')); ?>
        
        <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-2">
            <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php echo set_value('username'); ?>">
            </div>
        <p><?php echo form_error('username','<div class="text-danger">','</div>'); ?></p>
        </div>
        
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-2">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" value=""/>
            </div>

            <?php echo form_error('password','<div class="text-danger">','</div>'); ?> 
        </div>
        
        <div class="form-group">
            <label for="password_conf" class="col-sm-2 control-label">Password Confirmation</label>
            <div class="col-sm-2">
            <input type="password" name="password_conf" class="form-control" id="password_conf" placeholder="Password Confirmation" value="" /></p>
            </div>
            <p><?php echo form_error('password_conf','<div class="text-danger">','</div>'); ?></p>
        </div>
        <div class="col-sm-offset-2">
            <input type="submit" name="submit" class="btn btn-default" value="Register Account" />
            
            <p>Already have an account? Click <?php echo anchor('account/login','Login'); ?></p>
        </div>
        <?php echo form_close(); ?>
  
