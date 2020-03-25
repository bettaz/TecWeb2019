<div id="content">
        <h2>Preventivatore</h2>
        <form action="">
            <fieldset class="contenitore">
                <legend>Dati Generali</legend>

                <div class="linea">
                    <label for="nomeC">Nome cliente:</label>
                    <input name="nomeC" id="nomeC" value="nome cliente" maxlength="30"/>
                </div>

                <div class="linea">
                    <label for="cognomeC">Cognome cliente:</label>
                    <input name="cognomeC" id="cognomeC" value="cognome cliente" maxlength="40"/>
                </div>

                <div class="linea">
                    <label for="nomeD">Nome defunto/a:</label>
                    <input name="nomeD" id="nomeD" value="nome defunto/a" maxlength="30"/>
                </div>

                <div class="linea">
                    <label for="cognomeD">Cognome defunto/a:</label>
                    <input name="cognomeD" id="cognomeD" value="cognome defunto/a" maxlength="40"/>
                </div>

                <div class="linea">
                    <label for="via">Indirizzo cliente:</label>
                    <input name="via" id="via" value="via e numero civico" maxlength="80"/>
                </div>

                <div class="linea">
                    <label for="citta">Città cliente:</label>
                    <input name="citta" id="citta" value="città" maxlength="60"/>
                </div>

                <div class="linea">
                    <label for="provincia">Provincia:</label>
                    <select name="provincia" id="provincia">
                        <option selected="selected">---</option>
                        <optgroup label="Valle d&rsquo;Aosta">
                            <option value="AO">AOSTA</option>
                        </optgroup>

                        <optgroup label="Piemonte">
                            <option value="AL">ALESSANDRIA</option>
                            <option value="AT">ASTI</option>
                            <option value="BI">BIELLA</option>
                            <option value="CN">CUNEO</option>
                            <option value="NO">NOVARA</option>
                            <option value="TO">TORINO</option>
                            <option value="VB">VERBANO-CUSIO-OSSOLA</option>
                            <option value="VC">VERCELLI</option>

                        </optgroup>

                        <optgroup label="Liguria">
                            <option value="GE">GENOVA</option>
                            <option value="IM">IMPERIA</option>
                            <option value="SP">LA SPEZIA</option>
                            <option value="SV">SAVONA</option>
                        </optgroup>

                        <optgroup label="Lombardia">
                            <option value="BG">BERGAMO</option>
                            <option value="BS">BRESCIA</option>
                            <option value="CO">COMO</option>
                            <option value="CR">CREMONA</option>
                            <option value="LC">LECCO</option>
                            <option value="LO">LODI</option>
                            <option value="MN">MANTOVA</option>
                            <option value="MI">MILANO</option>
                            <option value="MB">MONZA - BRIANZA</option>
                            <option value="PV">PAVIA</option>
                            <option value="SO">SONDRIO</option>
                            <option value="VA">VARESE</option>
                        </optgroup>

                        <optgroup label="Trentino-Alto Adige">
                            <option value="BZ">BOLZANO</option>
                            <option value="TN">TRENTO</option>
                        </optgroup>

                        <optgroup label="Veneto">
                            <option value="BL">BELLUNO</option>
                            <option value="PD">PADOVA</option>
                            <option value="RO">ROVIGO</option>
                            <option value="TV">TREVISO</option>
                            <option value="VE">VENEZIA</option>
                            <option value="VR">VERONA</option>
                            <option value="VI">VICENZA</option>
                        </optgroup>

                        <optgroup label="Friuli-Venezia Giulia">
                            <option value="GO">GORIZIA</option>
                            <option value="PN">PORDENONE</option>
                            <option value="TS">TRIESTE</option>
                            <option value="UD">UDINE</option>
                        </optgroup>

                        <optgroup label="Emilia-Romagna">
                            <option value="BO">BOLOGNA</option>
                            <option value="FE">FERRARA</option>
                            <option value="FC">FORL&Igrave;-CESENA</option>
                            <option value="MO">MODENA</option>
                            <option value="PR">PARMA</option>
                            <option value="PC">PIACENZA</option>
                            <option value="RA">RAVENNA</option>
                            <option value="RE">REGGIO NELL&rsquo;EMILIA</option>
                            <option value="RN">RIMINI</option>
                        </optgroup>

                        <optgroup label="Toscana">
                            <option value="AR">AREZZO</option>
                            <option value="FI">FIRENZE</option>
                            <option value="GR">GROSSETO</option>
                            <option value="LI">LIVORNO</option>
                            <option value="LU">LUCCA</option>
                            <option value="MS">MASSA-CARRARA</option>
                            <option value="PI">PISA</option>
                            <option value="PT">PISTOIA</option>
                            <option value="PO">PRATO</option>
                            <option value="SI">SIENA</option>
                        </optgroup>

                        <optgroup label="Umbria">
                            <option value="PG">PERUGIA</option>
                            <option value="TR">TERNI</option>
                        </optgroup>

                        <optgroup label="Marche">
                            <option value="AN">ANCONA</option>
                            <option value="AP">ASCOLI PICENO</option>
                            <option value="FM">FERMO</option>
                            <option value="MC">MACERATA</option>
                            <option value="PU">PESARO E URBINO</option>
                        </optgroup>

                        <optgroup label="Lazio">
                            <option value="FR">FROSINONE</option>
                            <option value="LT">LATINA</option>
                            <option value="RM">ROMA</option>
                            <option value="RI">RIETI</option>
                            <option value="VT">VITERBO</option>
                        </optgroup>

                        <optgroup label="Abruzzo">
                            <option value="CH">CHIETI</option>
                            <option value="AQ">L&rsquo;AQUILA</option>
                            <option value="PE">PESCARA</option>
                            <option value="TE">TERAMO</option>

                        </optgroup>

                        <optgroup label="Molise">
                            <option value="CB">CAMPOBASSO</option>
                            <option value="IS">ISERNIA</option>
                        </optgroup>

                        <optgroup label="Campania">
                            <option value="AV">AVELLINO</option>
                            <option value="BN">BENEVENTO</option>
                            <option value="CE">CASERTA</option>
                            <option value="NA">NAPOLI</option>
                            <option value="SA">SALERNO</option>
                        </optgroup>

                        <optgroup label="Puglia">
                            <option value="BA">BARI</option>
                            <option value="BT">BARLETTA-ANDRIA-TRANI</option>
                            <option value="BR">BRINDISI</option>
                            <option value="FG">FOGGIA</option>
                            <option value="LE">LECCE</option>
                            <option value="TA">TARANTO</option>
                        </optgroup>

                        <optgroup label="Basilicata">
                            <option value="MT">MATERA</option>
                            <option value="PZ">POTENZA</option>
                        </optgroup>

                        <optgroup label="Calabria">
                            <option value="CZ">CATANZARO</option>
                            <option value="CS">COSENZA</option>
                            <option value="KR">CROTONE</option>
                            <option value="RC">REGGIO DI CALABRIA</option>
                            <option value="VV">VIBO VALENTIA</option>
                        </optgroup>

                        <optgroup label="Sicilia">
                            <option value="AG">AGRIGENTO</option>
                            <option value="CL">CALTANISSETTA</option>
                            <option value="CT">CATANIA</option>
                            <option value="EN">ENNA</option>
                            <option value="ME">MESSINA</option>
                            <option value="PA">PALERMO</option>
                            <option value="RG">RAGUSA</option>
                            <option value="SR">SIRACUSA</option>
                            <option value="TP">TRAPANI</option>

                        </optgroup>

                        <optgroup label="Sardegna">
                            <option value="CA">CAGLIARI</option>
                            <option value="CI">CARBONIA - IGLESIAS</option>
                            <option value="VS">MEDIO CAMPIDANO</option>
                            <option value="NU">NUORO</option>
                            <option value="OG">OGLIASTRA</option>
                            <option value="OT">OLBIA - TEMPIO</option>
                            <option value="OR">ORISTANO</option>
                            <option value="SS">SASSARI</option>
                        </optgroup>
                    </select>
                </div>

                <div class="linea">
                    <label for="cell">Numero di telefono:</label>
                    <input name="cell" id="cell" value="n. telefono" maxlength="10"/>
                </div>

            </fieldset>

            <fieldset class="contenitore">
                <legend>Dati acquisto</legend>

                <div class="linea">
                    <label for="bara">Modello bara:</label>
                    <select name="bara" id="bara">
                        <option selected="selected">---</option>
                        <optgroup label="Abete">
                            <option value="Alara">Lara</option>
                            <option value="Atorino">Torino</option>
                            <option value="Agianmaria">Gianmaria</option>
                        </optgroup>

                        <optgroup label="Mogano">
                            <option value="Mlara">Lara</option>
                            <option value="Mannamaria">Annamaria</option>
                            <option value="Mluigi">Luigi</option>
                            <option value="Mginevra">Ginevra</option>
                            <option value="Mluna">Luna</option>
                            <option value="Mtorino">Torino</option>

                        </optgroup>

                        <optgroup label="Betulla">
                            <option value="Bmario">Mario</option>
                            <option value="Bluigi">Luigi</option>
                            <option value="Bgina">Gina</option>
                            <option value="Bsavona">Savona</option>
                        </optgroup>
                    </select>
                </div>

                <div class="linea">
                    <label for="sicremazione">Desidero la cremazione </label>
                    <input name="cremazione" id="sicremazione" value="sicremazione" type="radio"/>
                    <label for="nocremazione">Non desidero la cremazione </label>
                    <input name="cremazione" id="nocremazione" value="nocremazione" type="radio"/>
                </div>

                <div class="linea">
                    <label for="urna">Modello urna:</label>
                    <select name="urna" id="urna">
                        <option selected="selected">---</option>
                        <optgroup label="Marmo">
                            <option value="Mciliegia">Ciliegia</option>
                            <option value="Mbetulla">Betulla</option>
                            <option value="Mlarice">Larice</option>
                        </optgroup>

                        <optgroup label="Acciaio"> <!-- sostituito acciaio rect con torino come da db-->
                            <option value="Atulipano">Tulipano</option>
                            <option value="Atorino">Torino</option>
                        </optgroup>

                        <optgroup label="Vetro">
                            <option value="Vfrancesca">Francesca</option>
                            <option value="Vrosa">Rosa</option>
                            <option value="Vpalermo">Palermo</option>
                            <option value="Vrect">Rect</option>
                        </optgroup>
                    </select>
                </div>

                <div class="linea"> <!-- tolte M in BMW-->
                    <label for="auto">Modello auto:</label>
                    <select name="auto" id="auto">
                        <option selected="selected">---</option>
                        <optgroup label="BW">
                            <option value="Bm3">M3</option>
                            <option value="Bx6">X6</option>
                            <option value="Bm8">M8</option>
                        </optgroup>

                        <optgroup label="Bentley"> <!-- tolte B in Bentley-->
                            <option value="Econtinental">Continental</option>
                        </optgroup>

                        <optgroup label="Mercedes">
                            <option value="Mgle">GLE</option>
                            <option value="Mgle">GLH</option>
                        </optgroup>

                        <optgroup label="Audi">
                            <option value="Aa4">A4</option>
                            <option value="Aa5">A5</option>
                            <option value="Aa6">A6</option>
                        </optgroup>

                        <optgroup label="Fiat">
                            <option value="Ffiorino">Fiorino</option>
                        </optgroup>
                    </select>
                </div>

                <div class="linea">
                    <label for="fiori">Composizione floreale:</label>
                    <select name="fiori" id="fiori">
                        <option selected="selected">---</option>
                        <optgroup label="Corone">
                            <option value="COgelsomino">Gelsolmino</option>
                        </optgroup>

                        <optgroup label="Cuscini">
                            <option value="CUgirasoli">Girasoli</option>
                        </optgroup>

                        <optgroup label="Ceste">
                            <option value="CEliliummisti">Lilium misti</option>
                            <option value="CEliliumrossi">Lilium rossi</option>
                        </optgroup>

                        <optgroup label="Mazzi">
                            <option value="Mrosebianche">Rose bianche</option>
                            <option value="Mroseblu">Rose blu</option>
                            <option value="Mroserosse">Rose rosse</option>
                        </optgroup>
                    </select>
                </div>

            </fieldset>
            <input type="submit" onclick="location.href='./tecweb2019/result.php';">
        </form>
        <!-- RISULTATI DA MOSTRARE IN UN' ALTRA PAGINA
        <div id="risultati">
            <p><strong>Totale di base: ------€ </strong></p>
            <p><strong>Totale di base ivato: ------€</strong></p>
        </div>
        -->
    </div>
