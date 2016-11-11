
        <?php echo form_open('/home/add_assignment',array('class'=>'form-horizontal')) ?>
        <div class="form-group">
        <label for="task" class="col-sm-2 control-label">Task</label>
        <div class="col-sm-8">
        <input class="form-control" id="task" type="text" placeholder="<?php echo $description; ?>" disabled>
        </div>
        </div>
        
        <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Assign To</label>
        <div class="col-sm-8">
            <input type="text" id="username" class="form-control" name="username" placeholder="username" value=""  />
        </div>
        <?php echo form_error('username','<div class="text-danger">','</div>'); ?>
        </div>
        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <input type="hidden" name="description" value="<?php echo $description; ?>" />
        <input type="hidden" name="page" value="<?php echo $page ?>"/>
        <div class="col-sm-offset-2">
            <input type="submit" name="submit" class="btn btn-default" value="Assign" />
            <input type="button" class="btn btn-default" value="back" onclick="window.location.assign('<?php echo site_url(array('home','index',$page)); ?>')" />
        </div>
        <?php echo form_close(); ?>

