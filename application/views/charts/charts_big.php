<div class="container">
    <br />
    <!-- Main hero unit for a primary marketing message or call to action -->
    <div class="hero-unit" id="general_div_maincontent" >
        <h1 id="charts_title"> Trends & Sales</h1>
        <br />
        <br />
        <div class="tabbable"> <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs">
                <li class="active"><a href="#users" data-toggle="tab">App Users</a></li>
                <li ><a href="#ads" data-toggle="tab">Ad Renvue</a></li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="users">
                    <div class="row-fluid">
                        <div class="span4">
                            <div style="display: inline-block; width: 100%;" class="span8">
                                <div class="accordion" id="accordion2_3">
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2_3" href="#collapseOne_1">
                                                Demographic Filter
                                            </a>
                                        </div>
                                        <div id="collapseOne_1" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                                <div>
                                                    <div style="width:100%">
                                                        <label >State: 
                                                            <select style="width: 120px;" data-statechange="true" data-name="state" id="campaign_state_charts_users" name="State"> 
                                                                <?php
                                                                if (isset($demo_charts_states_users)) {
                                                                    echo $demo_charts_states_users;
                                                                }
                                                                ?>
                                                            </select>
                                                        </label>
                                                    </div>
                                                    <div style="width:100%">
                                                        <label >City:&nbsp;&nbsp;  
                                                            <select style="width: 120px;"  data-name="city"  id="campaign_city_charts_users">
                                                                <option value="all">All</option> 
                                                            </select>
                                                        </label>
                                                    </div>
                                                    <div style="width:100%">
                                                        <label >Sex:&nbsp;&nbsp;&nbsp; 
                                                            <select style="width: 120px;"  data-name="sex"  id="campaign_sex_charts_users" name="campaign_sex">
                                                                <option value="all" >All</option>
                                                                <option value="male">male</option>
                                                                <option value="female">female</option>
                                                            </select>
                                                        </label>
                                                    </div>
                                                    <label style="width: 50px;">Age: </label>
                                                    <label class="checkbox inline " style="width: 50px;"><input type="checkbox" id="year1_charts_users" value="14-17">14-17</label>
                                                    <label class="checkbox inline " style="width: 50px;"><input type="checkbox" id="year2_charts_users" value="18-20">18-20</label>
                                                    <label class="checkbox inline " style="width: 50px;"><input type="checkbox" id="year3_charts_users" value="21-24">21-24</label>
                                                    <label class="checkbox inline " style="width: 50px;"><input type="checkbox" id="year4_charts_users" value="25-29">25-29</label>
                                                    <label class="checkbox inline " style="width: 50px;"><input type="checkbox" id="year5_charts_users" value="30-34">30-34</label>
                                                    <label class="checkbox inline " style="width: 50px;"><input type="checkbox" id="year6_charts_users" value="35-44">35-44</label>
                                                    <label class="checkbox inline " style="width: 50px;"><input type="checkbox" id="year7_charts_users" value="45-54">45-54</label>
                                                    <label class="checkbox inline " style="width: 50px;"><input type="checkbox" id="year8_charts_users" value="55-63">55-63</label>
                                                    <label class="checkbox inline " style="width: 130px;"><input type="checkbox" id="year9_charts_users" value="64 and up">64 and up</label>
                                                    <br />
                                                    <br />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2_3" href="#collapseTwo_1">
                                                Options
                                            </a>
                                        </div>
                                        <div id="collapseTwo_1" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                                 
                                                        <label >Phone Type:&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <select style="width: 120px;"   id="phone_type_users">
                                                                <option value="all">All</option> 
                                                                <option value="iPhone">iPhone</option> 
                                                                <option value="Android">Android</option> 
                                                                <option value="Windows">Windows</option> 
                                                                
                                                            </select>
                                                        </label>
                                               

                                              
                                                <label>Group By:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <select class="span6" id="demoChange_users">
                                                        <option value="age">Age</option>
                                                        <option value="location">Location</option>
                                                        <option value="gender" >Sex</option>
                                                        <option value="subscriber" >Subscribers</option>

                                                    </select>
                                                </label> 
                                                <label>Chart By:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <select class="span6" id="graph_by_users">
                                                        <option value="pie">Pie Chart</option>
                                                        <option value="Bar">Bar Chart</option>
                                                        <option value="line">Line Chart By Day</option>

                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div >
                                        <p>Start Date</p>



                                        <div class="input-prepend date" id="app_users_startdate" data-date="<?php echo date('m/d/Y', strtotime('-1 month')); ?>" data-date-format="dd-mm-yyyy" >
                                            <span class="add-on">
                                                <i class="icon-calendar">			  
                                                </i>
                                            </span>
                                            <input id="start_date_demo_1"  class="span16" size="16"  type="text" value="<?php echo date('m/d/Y', strtotime('-1 month')); ?>" readonly>

                                        </div>
                                    </div>

                                    <div >
                                        <p>End Date</p>
                                        <div class="input-prepend date" id="app_users_enddate" data-date="<?php echo date('m/d/Y'); ?>" data-date-format="dd-mm-yyyy">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                            <input id="end_date_demo_1" class="banking_history_dateinput span16" size="16"   type="text" value="<?php echo date('m/d/Y'); ?>" readonly>

                                        </div>
                                    </div>
                                    <button class="btn btn-success" id="submit_users">View</button>

                                </div>  
                            </div>
                        </div>
                        <div class="span8">
                            <div  id="userchart">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="ads" class="tab-pane">
                blue
            </div>
            </div>
            
            
        </div>
    </div>
</div>