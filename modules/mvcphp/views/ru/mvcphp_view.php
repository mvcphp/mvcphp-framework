            <div class="header"></div>
            <div class="panel">
                <div class="panel-text">
                    <span class="red">MVC</span><span class="green">PHP</span>
                    <span class="white"> конструктор</span>
                </div>
            </div>
            <div class="content">
                <div class="form">
                    <form action="/mvcphp/" method="post" enctype="application/x-www-form-urlencoded">
                        <div class="m-b-5 blue t-sh">Что конструировать</div>
                        <div class="m-b-15 green">
                            <label><input name="mvcphp_type" type="radio" value="1" checked="checked"> сайт</label>
                            <label><input name="mvcphp_type" type="radio" value="2"> админ</label>
                            <label><input name="mvcphp_type" type="radio" value="3"> модуль</label>
                        </div>
                        <div class="m-b-5 blue t-sh">Имя контроллера</div>
                        <div class="m-b-15">
                            <input class="inp-text fs-12 green" name="mvcphp_controller" type="text" value="">
                        </div>
                        <div class="m-b-5 blue t-sh">Имя действия</div>
                        <div class="m-b-15">
                            <input class="inp-text fs-12 green" name="mvcphp_action" type="text" value="index">
                        </div>
                        <div class="m-b-5 blue t-sh">Создаваемые файлы</div>
                        <div class="m-b-15 green">
                            <label><input name="mvcphp_file_c" type="checkbox" value="1" checked="checked"> контроллер</label>
                            <label><input name="mvcphp_file_m" type="checkbox" value="1" checked="checked"> модель</label>
                            <label><input name="mvcphp_file_v" type="checkbox" value="1" checked="checked"> представление</label>
                        </div>
                        <div class="m-b-5 blue t-sh">Тема (имя папки)</div>
                        <div class="m-b-15">
                            <input class="inp-text fs-12 green" name="mvcphp_theme" type="text" value="default">
                        </div>
                        <div class="m-b-5 blue t-sh">Язык (имя папки)</div>
                        <div class="m-b-15">
                            <input class="inp-text fs-12 green" name="mvcphp_language" type="text" value="ru">
                        </div>
                        <div class="m-b-15">
                            <input class="inp-sub" name="mvcphp_construct" type="submit" value="Генерировать">
                        </div>
                    </form>
                </div>
                <div class="result">
                    <div class="ta-center m-b-25 m-t-25 t-sh"><?php if(!empty($tpl->html_rout) || count($tpl->error)>0) { echo 'Результат:'; } ?></div>
                    <div class="red"><?php echo implode("<br>",$tpl->error); ?></div>
                    <div class="ta-center m-b-25 m-t-25 t-sh"><?php if(!empty($tpl->html_rout)) { echo 'Код для карты маршрутизации:'; } ?></div>
                    <div class="code"><?php echo $tpl->html_rout; ?></div>
                </div>
            </div>
            <div class="footer"></div>