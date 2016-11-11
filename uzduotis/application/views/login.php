
    
    <?php echo form_open('account/login',array('class'=>'form-horizontal','id'=>'signinForm')); ?>
    
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Username</label>
        <div class="col-sm-2">
        <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php echo set_value('username'); ?>">
        </div>
            <?php echo form_error('username','<div class="text-danger">','</div>'); ?>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-2">
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" value=""/>
        </div>

        <?php echo form_error('password','<div class="text-danger">','</div>'); ?> 
    </div>
    <div class="col-sm-offset-2"> 
   <input class="btn btn-default" type="submit" name="submit" value="Login" /> 
    <p>Don't have an account? Click <?php echo anchor('account/register','Register'); ?></p>
    </div>
    <?php echo form_close(); ?>

   
