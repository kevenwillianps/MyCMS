<div class="row">

    <div class="col-md-10">

        <h5>

            <strong>

                <i class="far fa-clipboard mr-1"></i>Usuários

            </strong>

            /Arquivos/Capa/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_PROFILE')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-12">

        <div class="card shadow-sm animate slideIn">

            <form class="card-body" role="form" id="formUsersFiles">

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="file" class="text-semi-bold">

                                Arquivo

                            </label>

                            <div class="custom-file">

                                <input type="file" class="custom-file-input" id="file" name="file" onchange="prepareUploadFile('#file')" accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="customFile">

                                    Choose file

                                </label>

                            </div>

                        </div>

                    </div>

                </div>

                <button type="button" class="btn btn-primary" onclick="prepareForm('#formUsersFiles')">

                    <i class="far fa-paper-plane mr-1"></i>Salvar

                </button>

                <input type="hidden" name="user_id" value="<?php echo utf8_encode($_POST['USER_ID'])?>"/>
                <input type="hidden" name="FOLDER" value="ACTION"/>
                <input type="hidden" name="TABLE" value="USERS_FILES"/>
                <input type="hidden" name="ACTION" value="USERS_FILES_SAVE_COVER"/>

            </form>

        </div>

    </div>

</div>