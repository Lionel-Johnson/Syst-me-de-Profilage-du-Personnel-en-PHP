<section>
    <div class="modal fade" id="faculty_profile" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class = "panel panel-primary">
                    <div class = "panel-heading">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>RAPORT DE PROFILE DU CORPS PROFESSORAL</h4>
                    </div>
                </div>
                <div class="modal-header">
                </div>
                <form action="" method="POST">
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-addon">
                        <input type="hidden" class="form-control" value="<?php echo $row['per_id']?>">
                        Nom du Rang: <span style="color: #000;"><?php echo $row['COUNT(bs_name)' + 'COUNT(bstotal)']; ?></span>
                        Nom du Rang: <span style="color: #000;"><?php echo $row['COUNT(bs_name)']; ?></span>
                        Nom du Rang: <span style="color: #000;"><?php echo $row['dept_name']; ?></span>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-lg" name = "save">Enregistrer</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</section>