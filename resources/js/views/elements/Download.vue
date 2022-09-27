<template>
    <div>
        <div class="row mb-6 justify-content-center" id="visitor-info" data-layout="1">
            <div class="col-12 text-wrapper">
                <form action="" method="post" class="" enctype="multipart/form-data" novalidate="novalidate">
                    <div class="d-none">
                        <input type="hidden" value="" name="formID" />
                        <input type="email" name="email" autocomplete="no" value="" />
                        <input type="hidden" name="" value="" />
                    </div>
                    <div class="row g-xs-2">
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-4">
                                <span class="form-control-con">
                                    <input id="field_1" required="" value="" class="form-control required" type="text" autocomplete="family-name" name="1" />
                                    <label>Name *</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-4">
                                <span class="form-control-con">
                                    <input id="field_2" required="" value="" class="form-control email required" type="email" autocomplete="email" name="2" />
                                    <label>E-mail *</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-4">
                                <span class="form-control-con">
                                    <input id="field_3" value="" class="form-control email required" type="tel" autocomplete="tel" name="3" />
                                    <label>Phone</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-4">
                                <span class="form-control-con">
                                    <input id="field_4" value="" class="form-control email required" type="text" autocomplete="company name" name="4" />
                                    <label>Company Name</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-4">
                                <span class="form-control-con">
                                    <input id="field_5" value="" class="form-control email required" type="text" autocomplete="address line 1" name="5" />
                                    <label>Address Line 1</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-4">
                                <span class="form-control-con">
                                    <input id="field_6" value="" class="form-control email required" type="text" autocomplete="address line 2" name="6" />
                                    <label>Address Line 1</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-4">
                                <span class="form-control-con">
                                    <input id="field_7" value="" class="form-control email required" type="text" autocomplete="address line 2" name="7" />
                                    <label>City</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-4">
                                <span class="form-control-con">
                                    <input id="field_8" value="" class="form-control email required" type="text" autocomplete="address line 2" name="8" />
                                    <label>State</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-4">
                                <span class="form-control-con">
                                    <input id="field_9" value="" class="form-control required" type="text" autocomplete="postal-code" name="9" />
                                    <label>Postal code</label>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group mb-4">
                                <span class="form-control-con select-con">
                                    <select id="field_10" name="3" class="form-control">
                                        <option></option>
                                        <optgroup label="Europe">
                                            <option value="Albania">Albania</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Kosovo">Kosovo</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macedonia">Macedonia</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Moldova">Moldova</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Republic of Serbia">Republic of Serbia</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="Yugoslavia">Yugoslavia</option>
                                        </optgroup>
                                        <optgroup label="North America">
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="United States">United States</option>
                                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        </optgroup>
                                        <optgroup label="Asia">
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="China">China</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="East Timor">East Timor</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option><option value="Kazakstan">Kazakstan</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Laos">Laos</option><option value="Lebanon">Lebanon</option><option value="Macao">Macao</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option>
                                            <option value="Mongolia">Mongolia</option><option value="Myanmar">Myanmar</option><option value="Nepal">Nepal</option><option value="North Korea">North Korea</option>
                                            <option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palestine">Palestine</option><option value="Philippines">Philippines</option>
                                            <option value="Qatar">Qatar</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Singapore">Singapore</option><option value="South Korea">South Korea</option>
                                            <option value="Sri Lanka">Sri Lanka</option><option value="Syria">Syria</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option>
                                            <option value="Thailand">Thailand</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option> <option value="Uzbekistan">Uzbekistan</option><option value="Vietnam">Vietnam</option><option value="Yemen">Yemen</option>
                                        </optgroup>
                                        <optgroup label="South America">
                                            <option value="Argentina">Argentina</option><option value="Bolivia">Bolivia</option><option value="Brazil">Brazil</option><option value="Chile">Chile</option>
                                            <option value="Colombia">Colombia</option><option value="Ecuador">Ecuador</option><option value="Falkland Islands">Falkland Islands</option><option value="French Guiana">French Guiana</option>
                                            <option value="Guyana">Guyana</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Suriname">Suriname</option><option value="Uruguay">Uruguay</option>
                                            <option value="Venezuela">Venezuela</option>
                                        </optgroup>
                                        <optgroup label="Africa">
                                            <option value="Algeria">Algeria</option><option value="Angola">Angola</option><option value="Benin">Benin</option><option value="Botswana">Botswana</option>
                                            <option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cameroon">Cameroon</option><option value="Cape Verde">Cape Verde</option>
                                            <option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option>
                                            <option value="Côte d’Ivoire">Côte d’Ivoire</option><option value="Djibouti">Djibouti</option><option value="Egypt">Egypt</option><option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option><option value="Ethiopia">Ethiopia</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Ghana">Ghana</option>
                                            <option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Kenya">Kenya</option><option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option>
                                            <option value="Mali">Mali</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option>
                                            <option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Namibia">Namibia</option><option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option><option value="Réunion">Réunion</option><option value="Rwanda">Rwanda</option><option value="Saint Helena">Saint Helena</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Senegal">Senegal</option><option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="Sudan">Sudan</option>
                                            <option value="Swaziland">Swaziland</option><option value="Tanzania">Tanzania</option><option value="Togo">Togo</option><option value="Tunisia">Tunisia</option>
                                            <option value="Uganda">Uganda</option><option value="Western Sahara">Western Sahara</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option>
                                        </optgroup>
                                        <optgroup label="Oceania">
                                            <option value="American Samoa">American Samoa</option><option value="Australia">Australia</option><option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option><option value="Cook Islands">Cook Islands</option><option value="Fiji Islands">Fiji Islands</option>
                                            <option value="French Polynesia">French Polynesia</option><option value="Guam">Guam</option><option value="Kiribati">Kiribati</option><option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Nauru">Nauru</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="Palau">Palau</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option><option value="Pitcairn">Pitcairn</option><option value="Samoa">Samoa</option><option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Tuvalu">Tuvalu</option><option value="Vanuatu">Vanuatu</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        </optgroup>
                                    </select>
                                    <label>Country</label>
                                </span>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="form-group mb-4">
                                <span class="form-control-con"><textarea id="field_11" rows="4" cols="60" name="11" class="form-control"></textarea> <label>Remarks</label> </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 xs-dn">
                            <div class="form-group mb-4">
                                <input type="hidden" id="field_12" name="12" value="" />
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 file-att">
                            <form action="/action_page.php">
                                <input type="file" id="myfile" name="myfile" />
                                <label for="myfile">Attach file here</label>
                                <br />
                                <br />
                                
                            </form>
                        </div>

                        <div class="col-12 col-sm-12">
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <div class="form-group mb-4">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" required="" class="form custom-control-input" name="13" id="field_13" />
                                            <label for="field_13" class="custom-control-label">I agree with the privacy policy *</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 col-md-4 d-flex">
                                    <button type="" class="btn btn-primary add-prdt">Add another product</button>
                                    <button type="submit" class="btn btn-primary sbmt">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 mt-3 sel-prdts">
                                <h5>Selected Products</h5>
                                <ul class="selected-p">
                                    <li>
                                        <label class="checkbox-item">Maple plain sliced, Quality B, Book Matched, Panel 48 x 120, Nauf MDF 3/4” 18mm
                                         <input type="checkbox" checked="checked">
                                          <span class="checkmark"></span>
                                         </label>
                                   </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Download",
        data() {
            return {
                imgpath: "/media/components",
            };
        },
    };
</script>
