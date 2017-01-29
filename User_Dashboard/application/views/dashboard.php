<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>Name^</td>
            <td>email</td>
            <td>created_at</td>
            <td>user_level</td>
            <?php if($user['user_level'] == '9'){?>
            <td>actions</td>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tabledata as $row){ ?>
            <tr>
                <td><?=$row['id']?></td>
                <td>
                    <a href=<?='/users/show/'.$row['id']?>> <?=$row['first_name'].' '.$row['last_name']?></a>
                </td>
                <td><?=$row['email']?></td>
                <td><?php echo date('F jS Y', strtotime($row['created_at']))?></td>
                <td><?php if($row['user_level'] == '9'){
                        echo 'admin';
                    }else{echo 'normal';}    ?></td>
                <?php if($user['user_level'] == '9'){ ?>
                <td>
                    <a href=<?='/users/edit/'.$row['id']?>>edit</a>
                    <a href=<?='/users/remove/'.$row['id']?>>remove</a>
                </td>
                <?php } ?>
            </tr>
        <?php  } ?>
    </tbody>
