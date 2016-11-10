<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="content-type" value="text/html; charset=ISO-8859-1">
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
    </head>
    <body>
        <?php if($role=="user"){  ?>
        
        <?php echo form_open('home/check_completed'); ?>
        <table class="table table-bordered table-condensed table-striped">
            <tr><th>Completed</th><th>Description</th></tr>
        <?php  foreach($tasks as $row){  ?>
    <tr>
           
        <td><?php 
            $data=array(
                'name' => 'completed[]',
                'checked' => $row['completed'],
                'value' => $row['id']
            );
            if($row['completed']==TRUE)
            { $data['disabled']='disabled';}
            echo form_checkbox($data);
           ?>
        </td>
        <td>
            <?php echo $row['description'];   ?>
        </td>

    </tr>
        <?php  }?>
        </table>
        <input type="hidden" name="page" value="<?php echo $page; ?>" />
        <input type="submit" class="btn btn-default" name="submit" value="Save" />
        <input type="button" class="btn btn-default" onclick="window.location.assign('<?php echo site_url(array('home','logout')); ?>')" value="Logout" />
        
        <?php echo form_close(); ?>
        
        <?php } if($role=="admin"){ ?>
        
        
        <table class="table table-bordered table-condensed table-striped">
            <tr>
                <th>Completed</th>
                <th>Description</th>
                <th>Assignments</th>
            </tr>
        <?php  foreach($tasks as $row){  ?>
    <tr>
           
        <td><?php  
            $data=array(
                'name' => 'completed[]',
                'checked' => $row['completed'],
                'value' => $row['id'],
                'disabled' =>'disabled'
            );
            
            echo form_checkbox($data);?>
            </td>
            <td>
                <?php   echo $row['description']; ?></td>
            <td>
                <?php echo $row['username'];?>
            </td>
            
            <td>
                <?php if($row['username']!=""){ ?>
                <input disabled="disabled" type="button" class="btn btn-default" onclick="window.location.assign('<?php echo site_url(array('home','assign',$row['id'])); ?>')" value="assign" />
                <?php } else {?>
                <input type="button" class="btn btn-default" onclick="window.location.assign('<?php echo site_url(array('home','assign','?id='.$row['id'].'&page='.$page)); ?>')" value="assign" />
                <?php }?>
            </td>
            <td>
                <input type="button" class="btn btn-default" onclick="window.location.assign('<?php echo site_url(array('home','edit','?id='.$row['id'].'&page='.$page)); ?>')" value="edit" />
            </td>
            <td>
                <input type="button" class="btn btn-default" onclick="window.location.assign('<?php echo site_url(array('home','delete','?id='.$row['id'].'&page='.$page)); ?>')" value="delete" />
            </td>

        
       
    </tr>
        <?php  }?>
        </table>
        
        
        <input type="button" class="btn btn-default" onclick="window.location.assign('<?php echo site_url(array('home','create','?pages='.$pages)); ?>')" value="Create Task" />
        <input type="button" class="btn btn-default" onclick="window.location.assign('<?php echo site_url(array('home','logout')); ?>')" value="Logout" />
        
        
        
        <?php } ?>
    
        <nav aria-label="Table Results">
            <ul class="pagination">
                <?php if($page==0){  ?>
                <li class="disabled"><a href="" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                <?php }else{ ?>
                <li ><a href="<?php echo site_url(array('home','index',$page-1)); ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                <?php } for($i=0;$i<$pages;$i++){ if($i==$page) { ?>
                <li class="active"><a href="<?php echo site_url(array('home','index',$i)); ?>"><?php echo $i;?></a></li>      
                <?php }else{?>
                <li><a href="<?php echo site_url(array('home','index',$i)); ?>"><?php echo $i;?></a></li> 
                <?php }} if($page==$pages-1){  ?>
                <li class="disabled"><a href="" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                <?php }else{ ?>
                <li ><a href="<?php echo site_url(array('home','index',$page+1)); ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                <?php } ?>
            </ul>
        </nav>
        
    </body>
    <script type="text/javascript" src="<?php echo base_url("assets/js/jQuery-1.10.2.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
</html>
