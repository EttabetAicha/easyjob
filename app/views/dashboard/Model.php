<!-- modal_template.php -->

<div class="modal fade" id="edit<?= $index ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method='POST' action="../Controller/controller.php">
                    <div class="row mb-4">
                        <div class="">
                            <label class="form-label">Username</label>
                            <input type="text" name='name' value='<?= $users['username'] ?>' class="form-control">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Email</label>
                        <input type="text" name='email' value='<?= $users['email'] ?>' class="form-control">
                    </div>
                    <div class="mb-4">
                    

                        <div class="mb-4">
                            <label class="form-label">Role User</label>
                            <select name="role" class="form-control" id="">
                                <option value="condidate" <?= ($users['role'] == 'condidate') ? "selected" : ""; ?>>Candidate</option>
                                <option value="admin" <?= ($users['role'] == 'admin') ? "selected" : ""; ?>>Admin</option>
                            </select>
                        </div>


                    </div>
                    <input type="hidden" name="id_user" value='<?= $users['userID'] ?>'>
                    <div class="d-flex w-100 justify-content-center">
                        <button type="submit" name='updateUser' class="btn btn-success mb-4 me-4">Save Edit</button>
                        <button class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>