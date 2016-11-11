
        <?php echo form_open('home/new_task',array('class'=>'form-horizontal'));?>
        
        <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-8">
        <input type="area" name="description" class="form-control" id="description" placeholder="Description" value="">
        </div>
        </div>
        <input type="hidden" name="pages" value="<?php echo $pages; ?>"/>
        <div class="col-sm-offset-2">
            <input type="submit" name="submit" class="btn btn-default" value="Create Task" />
            <input type="button" class="btn btn-default" value="back" onclick="window.location.assign('<?php echo site_url(array('home','index')); ?>')" />
        </div>
        
        <?php echo form_close(); ?>
   
