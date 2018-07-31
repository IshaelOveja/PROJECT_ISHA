<!DOCTYPE html>
<html>
    <head>
        <meta charset="iso-8859-1"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1250"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>CEP | COLEGIO DE ENFERMEROS DEL PERU</title>
        <link rel="icon" type="image/png" href="../img/icon.png">
        <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../Bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="../Bootstrap/css/animate.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
        <link href="../Bootstrap/css/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="../Bootstrap/css/bootstrapValidator.min.css" rel="stylesheet" type="text/css"/>
        <script src="../Bootstrap/js/jquery-3.1.1.min.js"></script>
        <script src="../Bootstrap/js/bootstrap.min.js"></script>
        <script src="../Bootstrap/js/plugins/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="../Bootstrap/js/bootstrapValidator.min.js" type="text/javascript"></script>
        <script src="js/index.js"></script>
        <script src="js/from.js"></script>
    </head>
    <body  style="font-family: 'Roboto', sans-serif;">
        <nav class="navbar navbar-inverse" style="margin-bottom: 6em; background-color: #fff; border-color: #fff;"><p id="prueba"></p></nav>
        <div class="container loginColumns animated fadeInDown">
            <div class="row">
                <div class="col-md-5">
                    <div class="ibox-content text-center">
                        <img class="img-responsive" src="../img/logo.jpg" style="display:flex;margin:0 auto;width: 30%;margin-bottom: 3em;"/>
                        <h3>FORMULARIO ELECTR&Oacute;NICO</h3><br>
                        <form class="m-t" role="form" id="frmRegisterCollege">
                            <div class="form-group">
                                <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-address-card-o"></i></span>
                                    <select class="form-control" name="frc_type_doc" required>
                                        <option value="0" selected>Seleccione Tipo de Documento</option>
                                        <option value="1">DNI</option>
                                        <option value="2">Carnet de Extranjer&iacute;a</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group m-b"><span class="input-group-addon">#</span> <input type="number" name="frc_num_doc" class="form-control" placeholder="N&uacute;mero de Documento" required=""></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-flag-o"></i></span>
                                    <select name="frc_country" class="form-control" required>
                                        <option value="0">Seleccione pa&iacute;s</option>
                                        <option value="2">AFGANISTAN                              </option>
                                        <option value="3">ALBANIA                                 </option>
                                        <option value="91">ALEMANIA                                </option>
                                        <option value="5">ANDORRA                                 </option>
                                        <option value="6">ANGOLA                                  </option>
                                        <option value="7">ANGUILA                                 </option>
                                        <option value="86">ANTARTIDA FRANCESA                      </option>
                                        <option value="8">ANTIGUA                                 </option>
                                        <option value="9">ANTILLAS HOLANDESAS                     </option>
                                        <option value="175">ANTILLAS HOLANDESAS                     </option>
                                        <option value="208">ARABIA SAUDI                            </option>
                                        <option value="4">ARGELIA                                 </option>
                                        <option value="10">ARGENTINA                               </option>
                                        <option value="11">ARMENIA                                 </option>
                                        <option value="12">ARUBA                                   </option>
                                        <option value="13">ASCENSION                               </option>
                                        <option value="14">AUSTRALIA                               </option>
                                        <option value="15">AUSTRIA                                 </option>
                                        <option value="16">AZERBAYAN                               </option>
                                        <option value="17">AZORES                                  </option>
                                        <option value="18">BAHAMAS                                 </option>
                                        <option value="19">BAHREIN                                 </option>
                                        <option value="20">BANGLADESH                              </option>
                                        <option value="22">BARBADOS                                </option>
                                        <option value="23">BARBUDA                                 </option>
                                        <option value="25">BELGICA                                 </option>
                                        <option value="26">BELICE                                  </option>
                                        <option value="27">BENIN                                   </option>
                                        <option value="28">BERMUDAS                                </option>
                                        <option value="24">BIELORRUSIA                             </option>
                                        <option value="40">BIRMANIA (MIANMAR)                      </option>
                                        <option value="30">BOLIVIA                                 </option>
                                        <option value="31">BONAIRE                                 </option>
                                        <option value="32">BOSNIA-HERZEGOVINA                      </option>
                                        <option value="33">BOTSUANA                                </option>
                                        <option value="34">BRASIL                                  </option>
                                        <option value="37">BRUNEI                                  </option>
                                        <option value="38">BULGARIA                                </option>
                                        <option value="39">BURKINA FASO                            </option>
                                        <option value="41">BURUNDI                                 </option>
                                        <option value="29">BUTAN                                   </option>
                                        <option value="46">CABO VERDE                              </option>
                                        <option value="42">CAMBOYA (CAMPUCHEA)                     </option>
                                        <option value="43">CAMERUN                                 </option>
                                        <option value="124">CAMPUCHEA                               </option>
                                        <option value="44">CANADA                                  </option>
                                        <option value="49">CHAD                                    </option>
                                        <option value="51">CHILE                                   </option>
                                        <option value="52">CHINA                                   </option>
                                        <option value="64">CHIPRE                                  </option>
                                        <option value="266">CIUDAD DEL VATICANO                     </option>
                                        <option value="55">COLOMBIA                                </option>
                                        <option value="56">COMORES                                 </option>
                                        <option value="57">CONGO                                   </option>
                                        <option value="59">C�RCEGA                                 </option>
                                        <option value="128">COREA DEL NORTE                         </option>
                                        <option value="129">COREA DEL SUR                           </option>
                                        <option value="119">COSTA DE MARFIL                         </option>
                                        <option value="60">COSTA RICA                              </option>
                                        <option value="61">CROACIA                                 </option>
                                        <option value="62">CUBA                                    </option>
                                        <option value="63">CURASAO                                 </option>
                                        <option value="66">DINAMARCA                               </option>
                                        <option value="67">DJIBUTI                                 </option>
                                        <option value="68">DOMINICA                                </option>
                                        <option value="71">ECUADOR                                 </option>
                                        <option value="72">EGIPTO                                  </option>
                                        <option value="73">EL SALVADOR                             </option>
                                        <option value="260">EMIRATOS ARABES UNIDOS                  </option>
                                        <option value="76">ERITREA                                 </option>
                                        <option value="209">ESCOCIA                                 </option>
                                        <option value="215">ESLOVAQUIA (REPUBLICA ESLOVACA)         </option>
                                        <option value="216">ESLOVENIA                               </option>
                                        <option value="220">ESPA�A                                  </option>
                                        <option value="1">ESTADOS UNIDOS                          </option>
                                        <option value="77">ESTONIA                                 </option>
                                        <option value="78">ETIOPIA                                 </option>
                                        <option value="81">FIJI                                    </option>
                                        <option value="193">FILIPINAS                               </option>
                                        <option value="82">FINLANDIA                               </option>
                                        <option value="83">FRANCIA                                 </option>
                                        <option value="89">FRANJA DE GAZA                          </option>
                                        <option value="273">FRANJA OCCIDENTAL</option>
                                        <option value="87">GABON                                   </option>
                                        <option value="271">GALES                                   </option>
                                        <option value="88">GAMBIA                                  </option>
                                        <option value="92">GHANA                                   </option>
                                        <option value="93">GIBRALTAR                               </option>
                                        <option value="94">GRAN BRETA�A                            </option>
                                        <option value="97">GRANADA                                 </option>
                                        <option value="95">GRECIA                                  </option>
                                        <option value="96">GROENLANDIA                             </option>
                                        <option value="98">GUADALUPE                               </option>
                                        <option value="99">GUATEMALA                               </option>
                                        <option value="103">GUAYANA BRIT�NICA                       </option>
                                        <option value="84">GUAYANA FRANCESA                        </option>
                                        <option value="100">GUERNSEY                                </option>
                                        <option value="101">GUINEA                                  </option>
                                        <option value="75">GUINEA ECUATORIAL                       </option>
                                        <option value="102">GUINEA-BISSAU                           </option>
                                        <option value="104">HAITI                                   </option>
                                        <option value="106">HOLANDA                                 </option>
                                        <option value="107">HONDURAS                                </option>
                                        <option value="108">HONG KONG                               </option>
                                        <option value="109">HUNGRIA                                 </option>
                                        <option value="111">INDIA                                   </option>
                                        <option value="112">INDONESIA                               </option>
                                        <option value="74">INGLATERRA                              </option>
                                        <option value="114">IRAK                                    </option>
                                        <option value="113">IRAN                                    </option>
                                        <option value="185">IRLANDA DEL NORTE                       </option>
                                        <option value="54">ISLA DE COCOS (KEELING)                 </option>
                                        <option value="259">ISLA UNION                              </option>
                                        <option value="270">ISLA WAKE                               </option>
                                        <option value="110">ISLANDIA                                </option>
                                        <option value="47">ISLAS CAIM�N                            </option>
                                        <option value="45">ISLAS CANARIAS                          </option>
                                        <option value="58">ISLAS COOK                              </option>
                                        <option value="263">ISLAS DE EE.UU. MINOR OUTLYING          </option>
                                        <option value="50">ISLAS DEL CANAL                         </option>
                                        <option value="80">ISLAS FEROE                             </option>
                                        <option value="105">ISLAS HEARD Y MCDONALD                  </option>
                                        <option value="145">ISLAS MADEIRA                           </option>
                                        <option value="79">ISLAS MALVINAS                          </option>
                                        <option value="184">ISLAS NORFOLK                           </option>
                                        <option value="194">ISLAS PITCAIRN                          </option>
                                        <option value="217">ISLAS SALOM�N                           </option>
                                        <option value="234">ISLAS SVALBARD Y JAN MAYEN              </option>
                                        <option value="255">ISLAS TURKS Y CAICOS                    </option>
                                        <option value="269">ISLAS VIRGENES (BRITANICAS)             </option>
                                        <option value="36">ISLAS VIRGENES BRIT�NICAS               </option>
                                        <option value="272">ISLAS WALLIS Y FUTUNA                   </option>
                                        <option value="117">ISRAEL                                  </option>
                                        <option value="118">ITALIA                                  </option>
                                        <option value="120">JAMAICA                                 </option>
                                        <option value="121">JAPON                                   </option>
                                        <option value="122">JERSEY                                  </option>
                                        <option value="123">JORDANIA                                </option>
                                        <option value="125">KAZAJSTAN                               </option>
                                        <option value="126">KENIA                                   </option>
                                        <option value="132">KIRGUIZISTAN                            </option>
                                        <option value="127">KIRIBATI                                </option>
                                        <option value="130">KOSRAE                                  </option>
                                        <option value="131">KUWAIT                                  </option>
                                        <option value="133">LAOS                                    </option>
                                        <option value="136">LESOTO                                  </option>
                                        <option value="134">LETONIA                                 </option>
                                        <option value="135">LIBANO                                  </option>
                                        <option value="137">LIBERIA                                 </option>
                                        <option value="138">LIBIA                                   </option>
                                        <option value="139">LIECHTENSTEIN                           </option>
                                        <option value="140">LITUANIA                                </option>
                                        <option value="141">LUXEMBURGO                              </option>
                                        <option value="142">MACAO                                   </option>
                                        <option value="144">MADAGASCAR                              </option>
                                        <option value="147">MALASIA                                 </option>
                                        <option value="146">MALAUI                                  </option>
                                        <option value="148">MALDIVAS                                </option>
                                        <option value="149">MALI                                    </option>
                                        <option value="150">MALTA                                   </option>
                                        <option value="169">MARRUECOS                               </option>
                                        <option value="151">MARTINICA                               </option>
                                        <option value="153">MAURICIO                                </option>
                                        <option value="152">MAURITANIA                              </option>
                                        <option value="154">MEXICO                                  </option>
                                        <option value="171">MIANMAR                                 </option>
                                        <option value="155">MOLDAVIA                                </option>
                                        <option value="156">MONACO                                  </option>
                                        <option value="157">MONGOLIA                                </option>
                                        <option value="158">MONTENEGRO                              </option>
                                        <option value="159">MONTSERRAT                              </option>
                                        <option value="170">MOZAMBIQUE                              </option>
                                        <option value="172">NAMIBIA                                 </option>
                                        <option value="173">NAURU                                   </option>
                                        <option value="53">NAVIDAD, ISLAS                          </option>
                                        <option value="174">NEPAL                                   </option>
                                        <option value="177">NEVIS                                   </option>
                                        <option value="180">NICARAGUA                               </option>
                                        <option value="181">NIGER                                   </option>
                                        <option value="182">NIGERIA                                 </option>
                                        <option value="183">NIUE                                    </option>
                                        <option value="186">NORUEGA                                 </option>
                                        <option value="178">NUEVA CALEDONIA                         </option>
                                        <option value="179">NUEVA ZELANDA                           </option>
                                        <option value="187">OMAN                                    </option>
                                        <option value="1000">OTRA</option>
                                        <option value="176">PAISES BAJOS                            </option>
                                        <option value="189">PANAMA                                </option>
                                        <option value="190">PAPUA NUEVA GUINEA                      </option>
                                        <option value="188">PAQUISTAN                               </option>
                                        <option value="191">PARAGUAY                                </option>
                                        <option value="192" selected>PERU                                    </option>
                                        <option value="195">POHNPEI                                 </option>
                                        <option value="85">POLINESIA FRANCESA                      </option>
                                        <option value="196">POLONIA                                 </option>
                                        <option value="197">PORTUGAL                                </option>
                                        <option value="282">PUERTO RICO                             </option>
                                        <option value="198">QATAR                                   </option>
                                        <option value="261">REINO UNIDO                             </option>
                                        <option value="48">REPUBLICA CENTROAFRICANA                </option>
                                        <option value="65">REPUBLICA CHECA                         </option>
                                        <option value="90">REPUBLICA DE GEORGIA                    </option>
                                        <option value="116">REPUBLICA DE IRLANDA                    </option>
                                        <option value="143">REPUBLICA DE MACEDONIA                  </option>
                                        <option value="69">REPUBLICA DOMINICANA                    </option>
                                        <option value="199">REUNION                                 </option>
                                        <option value="201">ROTA                                    </option>
                                        <option value="203">RUANDA                                  </option>
                                        <option value="200">RUMANIA                                 </option>
                                        <option value="202">RUSIA                                   </option>
                                        <option value="204">SABA                                    </option>
                                        <option value="275">SAHARA OCCIDENTAL</option>
                                        <option value="226">SAINT KITTS                             </option>
                                        <option value="205">SAIP�N                                  </option>
                                        <option value="274">SAMOA OCCIDENTAL</option>
                                        <option value="222">SAN BARTOLOME                           </option>
                                        <option value="206">SAN MARINO (ITALIA)                     </option>
                                        <option value="229">SAN MARTIN                              </option>
                                        <option value="231">SAN VICENTE                             </option>
                                        <option value="225">SANTA ELENA                             </option>
                                        <option value="227">SANTA LUCIA                             </option>
                                        <option value="207">SANTO TOME Y PRINCIPE                   </option>
                                        <option value="210">SENEGAL                                 </option>
                                        <option value="211">SERBIA                                  </option>
                                        <option value="212">SEYCHELLES                              </option>
                                        <option value="213">SIERRA LEONA                            </option>
                                        <option value="0">SIN DATOS</option>
                                        <option value="214">SINGAPUR                                </option>
                                        <option value="238">SIRIA                                   </option>
                                        <option value="218">SOMALIA                                 </option>
                                        <option value="221">SRI LANKA                               </option>
                                        <option value="223">ST. CHRISTOPHER                         </option>
                                        <option value="224">ST. EUSTATIUS                           </option>
                                        <option value="228">ST. MAARTEN                             </option>
                                        <option value="230">ST. PIERRE Y MIQUELON                   </option>
                                        <option value="235">SUAZILANDIA                             </option>
                                        <option value="219">SUDAFRICA                               </option>
                                        <option value="232">SUDAN                                   </option>
                                        <option value="236">SUECIA                                  </option>
                                        <option value="237">SUIZA                                   </option>
                                        <option value="233">SURINAM                                 </option>
                                        <option value="239">TAHITI                                  </option>
                                        <option value="243">TAILANDIA                               </option>
                                        <option value="240">TAIWAN                                  </option>
                                        <option value="242">TANZANIA                                </option>
                                        <option value="241">TAYIKISTAN                              </option>
                                        <option value="35">TERRIT. BRITANICOS DEL OCEANO INDICO    </option>
                                        <option value="70">TIMOR ORIENTAL                          </option>
                                        <option value="244">TINIAN                                  </option>
                                        <option value="245">TOGO                                    </option>
                                        <option value="246">TOKELAU                                 </option>
                                        <option value="247">TONGA                                   </option>
                                        <option value="248">TORTOLA                                 </option>
                                        <option value="249">TRINIDAD Y TOBAGO                       </option>
                                        <option value="250">TRISTAN DA CUNHA                        </option>
                                        <option value="251">TRUK                                    </option>
                                        <option value="252">TUNEZ                                   </option>
                                        <option value="254">TURKMENISTAN                            </option>
                                        <option value="253">TURQUIA                                 </option>
                                        <option value="256">TUVALU                                  </option>
                                        <option value="258">UCRANIA                                 </option>
                                        <option value="257">UGANDA                                  </option>
                                        <option value="262">URUGUAY                                 </option>
                                        <option value="264">UZBEKISTAN                              </option>
                                        <option value="265">VANUATU                                 </option>
                                        <option value="267">VENEZUELA                               </option>
                                        <option value="268">VIETNAM                                 </option>
                                        <option value="276">YAP</option>
                                        <option value="277">YEMEN</option>
                                        <option value="278">YUGOSLAVIA</option>
                                        <option value="279">ZAIRE</option>
                                        <option value="280">ZAMBIA</option>
                                        <option value="281">ZIMBABUE</option>
                                        <option value="115">ZONA NEUTRAL IRAK-SAUDI                 </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="frc_surname_f" placeholder="Apellido Paterno" required="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="frc_surname_m" placeholder="Apellido Materno" required="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="frc_name_o" placeholder="Primer Nombre" required="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="frc_name_t" placeholder="Segundo Nombre" required="">
                            </div>
                            <div class="form-group">
                                <div class="input-group m-b"><span class="input-group-addon">@</span><input type="email" class="form-control" name="frc_email" placeholder="Correo Electr&oacute;nico" required=""></div>
                            </div>
                            <div class="form-group">
                                <div class="input-group m-b"><span class="input-group-addon"><i class="fa fa-mobile"></i></span><input type="number" class="form-control" name="frc_mobile" placeholder="N&uacute;mero de Celular" required=""></div>
                            </div>
                            <button type="submit" class="btn btn-primary block full-width m-b">Registrarse</button>
                        </form>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            Colegio de Enfermeros del Per&uacute; 
                        </div>
                        <div class="col-md-6 text-right">
                            <small>© 2018</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h3>REQUISITOS</h3>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#nacional">NACIONALES</a></li>
                        <li><a data-toggle="tab" href="#extranjero">EXTRANJEROS</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="nacional" class="tab-pane fade in active">
                            <div class="panel-body">
                                <p> </p><ul>
                                    <li>Título original de Licenciatura en Enfermería.</li>
                                    <li>Copia de constancia de inscripción en el Registro Nacional de Grados y Títulos(**)</li>
                                    <li>Copia de constancia de verificación de firma registrada ante SUNEDU (**)</li>
                                    <li>Fotocopia del Título original, legalizada por Notario Público. (*)</li>
                                    <li>Certificados de estudios originales de los diez semestres académicos universitarios. (*)</li>
                                    <li>Fotocopia simple de certificado de estudios.</li>
                                    <li>Constancia original de ingreso a la Universidad</li>
                                    <li>Resolución en caso de convalidación de asignaturas cursadas en otra universidad&nbsp;<br>
                                        y presentación de sílabos originales visados por la universidad. (*)</li>
                                    <li>Tres (03) fotos tamaño carné a color (fondo blanco) con uniforme turquesa,&nbsp;<br>
                                        cabello recogido (mujeres) / cabello corto varones.</li>
                                    <li>Una (01) foto tamaño pasaporte a color (fondo blanco) con uniforme turquesa,&nbsp;<br>
                                        cabello recogido (mujeres) / cabello corto varones.</li>
                                    <li>Declaración Jurada, legalizada por Notario Público. (**)</li>
                                    <li>Fotocopia Simple de DNI. (*)</li>
                                    <li>Voucher de pago correspondiente. (*)</li>
                                    <li>Archivo digital del trabajo de investigación en el caso de los titulados por tesis.</li>
                                </ul>
                                <br>
                                <p>Presentar la documentación al Consejo Regional correspondiente.</p>
                                <ul>
                                    <!--<li>Ficha de Inscripción con toda la información solicitada. (*)</li>-->
                                    <li>Ficha única con toda la información solicitada. (*)</li>
                                    <!--<li>Solicitud de Inscripción. (*)</li>-->
                                    <li>Formato de Carné.</li>
                                    <!-- <li>Dictamen sobre solicitud de Inscripción. (*)</li>
                                     <li>Compromiso de Honor.</li>-->
                                    <li>Declaración Jurada</li>
                                </ul>
                                <br>
                                <p>Estos documentos se emiten de formato electrónico, llenar dichos formularios.</p>
                                <p><strong>(*) Adjuntar con una copia simple adicional.<br>
                                        (**) Adjuntar con una copia legalizada por Notario Público</strong></p>

                                <p></p>

                            </div>
                        </div>
                        <div id="extranjero" class="tab-pane fade">
                            <div class="panel-body">
                                <p></p><ul>
                                    <!-- <li>Reconocimiento del T&iacute;tulo Original de Licenciado en Enfermer&iacute;a en la (SUNEDU). </li>
                                     <li> (Superintendencia Nacional de Educaci&oacute;n Universitaria)</li>-->
                                    <li> Revalidación de grado Académico en Universidades autorizadas por la (SUNEDU) <br>
                                        SEGÚN INDICA EL ARTÍCULO 11º DEL ESTATUTO Y EL ARTÍCULO 6º DEL REGLAMENTO DEL CEP</li>
                                    <li> Título con las firmas legalizadas por el Consulado Peruano del país de origen y Apostilla de la Haya.<br>
                                        (Traducción oficial cuando el Título no este en castellano) </li>
                                    <li> Copia legalizada del Título, anverso y reverso.</li>
                                    <li> Original y copia legalizada de Resolución del reconocimiento de SUNEDU.</li>
                                    <li> Copia legalizada del Certificado de Estudios (notas) emitido por la Universidad.<br>
                                        (Traducción oficial cuando el certificado no este en castellano)</li>
                                    <li> Copia legalizada del carnet de extranjería. </li>
                                    <li> Tres (03) fotos tamaño carné a color (fondo blanco) con uniforme turquesa, <br>
                                        cabello recogido (mujeres) / cabello corto varones.</li>
                                    <li> Una (01) foto tamaño pasaporte a color (fondo blanco) con uniforme turquesa, <br>
                                        cabello recogido (mujeres) / cabello corto varones.</li>
                                    <li> Voucher de pago correspondiente. (*)<br>
                                    </li>
                                </ul>
                                <br>
                                <p>Presentar la documentación al Consejo Regional correspondiente.</p>
                                <ul class="greyarrow">
                                    <!--<li>Ficha de Inscripci�n con toda la informaci�n solicitada. (*)</li>-->
                                    <li>Ficha única con toda la información solicitada. (*)</li>
                                    <!--<li>Solicitud de Inscripci�n. (*)</li>-->
                                    <li>Formato de Carné.</li>
                                    <!-- <li>Dictamen sobre solicitud de Inscripci�n. (*)</li>
                                     <li>Compromiso de Honor.</li>-->
                                    <li>Declaración Jurada</li>
                                </ul>
                                <br>
                                <p>Estos documentos se emiten de formato electrónico,  llenar dichos formularios.</p>
                                <p><strong>(*) Adjuntar con una copia simple adicional.<br>
                                        (**) Adjuntar con una copia legalizada por Notario Público</strong></p>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
        </div>
    </body>
</html>