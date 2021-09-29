<div class="row animate slideIn">

    <div class="col-md-12 text-center">

        <img src="image/logo.png" alt="" width="60px">

        <div class="my-3">

            <h4 class="">

                Redefinição de senha do

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

                        <button type="button" class="btn btn-primary btn-block" onclick="sendForm('#formUsuarioLogin')">

                            <i class="far fa-paper-plane mr-1"></i>Solicitar

                        </button>

                    </div>

                    <input type="hidden" name="FOLDER" value="ACTION"/>
                    <input type="hidden" name="TABLE" value="USERS"/>
                    <input type="hidden" name="ACTION" value="USERS_REQUEST_RESET_PASSWORD"/>

                </form>

            </div>

        </div>

        <button type="button" class="btn btn-outline-primary btn-block mt-3" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_LOGIN')">

            Realizar <strong>Login</strong>

        </button>

    </div>

</div>