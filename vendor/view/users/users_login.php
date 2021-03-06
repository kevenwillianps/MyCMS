<div class="row animate slideIn">

    <div class="col-md-12 text-center">

        <img src="image/logo-rounded.png" alt="" width="60px">

        <div class="my-3">

            <h4 class="">

                Faça login no

                <strong>

                    MyCMS

                </strong>

            </h4>

        </div>

    </div>

    <div class="col-md-4 mx-auto">

        <div class="card shadow-sm">

            <div class="card-body">

                <form class="row" role="form" id="formUsuarioLogin">

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="email">

                                Email <span class="text-danger">*</span>

                            </label>

                            <input type="text" class="form-control" name="email" id="email">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="password">

                                Senha <span class="text-danger">*</span>

                            </label>

                            <input type="password" class="form-control" name="password" id="password">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <button type="button" class="btn btn-primary btn-block" onclick="sendForm('#formUsuarioLogin')">

                            <i class="far fa-paper-plane mr-1"></i>Acessar

                        </button>

                    </div>

                    <div class="col-md-12 text-right mt-3">

                        <a type="button" class="text-primary" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_FORM_REQUEST_RESET_PASSWORD')">

                            Esqueci a <strong>senha</strong>

                        </a>

                    </div>

                    <input type="hidden" name="FOLDER" value="ACTION"/>
                    <input type="hidden" name="TABLE" value="USERS"/>
                    <input type="hidden" name="ACTION" value="USERS_LOGIN"/>

                </form>

            </div>

        </div>

        <button type="button" class="btn btn-outline-primary btn-block mt-3" onclick="request('FOLDER=VIEW&PRODUCT=GR&TABLE=GUSUARIO&ACTION=G_USUARIO_REGISTER')">

            Novo no MyCMS? <strong>Crie uma conta</strong>

        </button>

    </div>

</div>