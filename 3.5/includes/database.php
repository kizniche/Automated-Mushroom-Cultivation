<?php
/*
*  database.php - Load database values as variables
*
*  Copyright (C) 2015  Kyle T. Gabriel
*
*  This file is part of Mycodo
*
*  Mycodo is free software: you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation, either version 3 of the License, or
*  (at your option) any later version.
*
*  Mycodo is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
*  GNU General Public License for more details.
*
*  You should have received a copy of the GNU General Public License
*  along with Mycodo. If not, see <http://www.gnu.org/licenses/>.
*
*  Contact at kylegabriel.com
*/

$db = new SQLite3($mycodo_db);
$udb = new SQLite3($user_db);
$ndb = new SQLite3($note_db);

$logged_in_user = $_SESSION['user_name'];

$results = $udb->query('SELECT user_name,
                               user_email,
                               user_restriction,
                               user_theme
                        FROM   users');
$i = 0;
while ($row = $results->fetchArray()) {
    $user_name[$i] = $row[0];
    $user_email[$i] = $row[1];
    $user_restriction[$i] = $row[2];
    $user_theme[$i] = $row[3];
    $i++;
}

$results = $udb->query("SELECT user_restriction,
                               user_theme
                        FROM   users
                        WHERE  user_name='" . $logged_in_user . "'");
while ($row = $results->fetchArray()) {
    $current_user_restriction = $row[0];
    $current_user_theme = $row[1];
}

unset($relay_id);
$results = $db->query('SELECT id,
                              name,
                              pin,
                              amps,
                              trigger,
                              start_state
                       FROM   relays');
$i = 0;
while ($row = $results->fetchArray()) {
    $relay_id[$i] = $row[0];
    $relay_name[$i] = $row[1];
    $relay_pin[$i] = $row[2];
    $relay_amps[$i] = $row[3];
    $relay_trigger[$i] = $row[4];
    $relay_start_state[$i] = $row[5];
    $i++;
}
if (!isset($relay_id)) $relay_id = [];

// conditional statements
unset($conditional_relay_id);
$results = $db->query('SELECT id,
                              name,
                              if_relay,
                              if_action,
                              if_duration,
                              sel_relay,
                              do_relay,
                              do_action,
                              do_duration,
                              sel_command,
                              do_command,
                              sel_notify,
                              do_notify
                       FROM   relayconditional');
$i = 0;
while ($row = $results->fetchArray()) {
    $conditional_relay_id[$i] = $row[0];
    $conditional_relay_name[$i] = $row[1];
    $conditional_relay_ifrelay[$i] = $row[2];
    $conditional_relay_ifaction[$i] = $row[3];
    $conditional_relay_ifduration[$i] = $row[4];
    $conditional_relay_sel_relay[$i] = $row[5];
    $conditional_relay_dorelay[$i] = $row[6];
    $conditional_relay_doaction[$i] = $row[7];
    $conditional_relay_doduration[$i] = $row[8];
    $conditional_relay_sel_command[$i] = $row[9];
    $conditional_relay_command[$i] = str_replace("''","'",$row[10]);
    $conditional_relay_sel_notify[$i] = $row[11];
    $conditional_relay_notify[$i] = $row[12];
    $i++;
}
if (!isset($conditional_relay_id)) $conditional_relay_id = [];

unset($sensor_t_id);
$results = $db->query('SELECT id,
                              name,
                              pin,
                              device,
                              period,
                              pre_measure_relay,
                              pre_measure_dur,
                              activated,
                              graph,
                              yaxis_relay_min,
                              yaxis_relay_max,
                              yaxis_relay_tics,
                              yaxis_relay_mtics,
                              yaxis_temp_min,
                              yaxis_temp_max,
                              yaxis_temp_tics,
                              yaxis_temp_mtics,
                              temp_relays_up,
                              temp_relays_down,
                              temp_relay_high,
                              temp_outmin_high,
                              temp_outmax_high,
                              temp_relay_low,
                              temp_outmin_low,
                              temp_outmax_low,
                              temp_or,
                              temp_set,
                              temp_set_direction,
                              temp_period,
                              temp_p,
                              temp_i,
                              temp_d
                       FROM   tsensor');
$i = 0;
while ($row = $results->fetchArray()) {
    $sensor_t_id[$i] = $row[0];
    $sensor_t_name[$i] = $row[1];
    $sensor_t_pin[$i] = $row[2];
    $sensor_t_device[$i] = $row[3];
    $sensor_t_period[$i] = $row[4];
    $sensor_t_premeasure_relay[$i] = $row[5];
    $sensor_t_premeasure_dur[$i] = $row[6];
    $sensor_t_activated[$i] = $row[7];
    $sensor_t_graph[$i] = $row[8];
    $sensor_t_yaxis_relay_min[$i] = $row[9];
    $sensor_t_yaxis_relay_max[$i] = $row[10];
    $sensor_t_yaxis_relay_tics[$i] = $row[11];
    $sensor_t_yaxis_relay_mtics[$i] = $row[12];
    $sensor_t_yaxis_temp_min[$i] = $row[13];
    $sensor_t_yaxis_temp_max[$i] = $row[14];
    $sensor_t_yaxis_temp_tics[$i] = $row[15];
    $sensor_t_yaxis_temp_mtics[$i] = $row[16];
    $sensor_t_temp_relays_up[$i] = $row[17];
    $sensor_t_temp_relays_down[$i] = $row[18];
    $pid_t_temp_relay_high[$i] = $row[19];
    $pid_t_temp_outmin_high[$i] = $row[20];
    $pid_t_temp_outmax_high[$i] = $row[21];
    $pid_t_temp_relay_low[$i] = $row[22];
    $pid_t_temp_outmin_low[$i] = $row[23];
    $pid_t_temp_outmax_low[$i] = $row[24];
    $pid_t_temp_or[$i] = $row[25];
    $pid_t_temp_set[$i] = $row[26];
    $pid_t_temp_set_dir[$i] = $row[27];
    $pid_t_temp_period[$i] = $row[28];
    $pid_t_temp_p[$i] = $row[29];
    $pid_t_temp_i[$i] = $row[30];
    $pid_t_temp_d[$i] = $row[31];
    $i++;
}
if (!isset($sensor_t_id)) $sensor_t_id = [];
if (!isset($sensor_t_graph)) $sensor_t_graph = [];

unset($sensor_ht_id);
$results = $db->query('SELECT id,
                              name,
                              pin,
                              clock_pin,
                              sensor_voltage,
                              device,
                              period,
                              pre_measure_relay,
                              pre_measure_dur,
                              activated,
                              graph,
                              verify_pin,
                              verify_temp,
                              verify_temp_notify,
                              verify_temp_stop,
                              verify_hum,
                              verify_hum_notify,
                              verify_hum_stop,
                              verify_notify_email,
                              yaxis_relay_min,
                              yaxis_relay_max,
                              yaxis_relay_tics,
                              yaxis_relay_mtics,
                              yaxis_temp_min,
                              yaxis_temp_max,
                              yaxis_temp_tics,
                              yaxis_temp_mtics,
                              yaxis_hum_min,
                              yaxis_hum_max,
                              yaxis_hum_tics,
                              yaxis_hum_mtics,
                              temp_relays_up,
                              temp_relays_down,
                              temp_relay_high,
                              temp_outmin_high,
                              temp_outmax_high,
                              temp_relay_low,
                              temp_outmin_low,
                              temp_outmax_low,
                              temp_or,
                              temp_set,
                              temp_set_direction,
                              temp_period,
                              temp_p,
                              temp_i,
                              temp_d,
                              hum_relays_up,
                              hum_relays_down,
                              hum_relay_high,
                              hum_outmin_high,
                              hum_outmax_high,
                              hum_relay_low,
                              hum_outmin_low,
                              hum_outmax_low,
                              hum_or,
                              hum_set,
                              hum_set_direction,
                              hum_period,
                              hum_p,
                              hum_i,
                              hum_d
                       FROM   htsensor');
$i = 0;
while ($row = $results->fetchArray()) {
    $sensor_ht_id[$i] = $row[0];
    $sensor_ht_name[$i] = $row[1];
    $sensor_ht_pin[$i] = $row[2];
	$sensor_ht_clock_pin[$i] = $row[3];
	$sensor_ht_voltage[$i] = $row[4];
    $sensor_ht_device[$i] = $row[5];
    $sensor_ht_period[$i] = $row[6];
    $sensor_ht_premeasure_relay[$i] = $row[7];
    $sensor_ht_premeasure_dur[$i] = $row[8];
    $sensor_ht_activated[$i] = $row[9];
    $sensor_ht_graph[$i] = $row[10];
    $sensor_ht_verify_pin[$i] = $row[11];
    $sensor_ht_verify_temp[$i] = $row[12];
    $sensor_ht_verify_temp_notify[$i] = $row[13];
    $sensor_ht_verify_temp_stop[$i] = $row[14];
    $sensor_ht_verify_hum[$i] = $row[15];
    $sensor_ht_verify_hum_notify[$i] = $row[16];
    $sensor_ht_verify_hum_stop[$i] = $row[17];
    $sensor_ht_verify_email[$i] = $row[18];
    $sensor_ht_yaxis_relay_min[$i] = $row[19];
    $sensor_ht_yaxis_relay_max[$i] = $row[20];
    $sensor_ht_yaxis_relay_tics[$i] = $row[21];
    $sensor_ht_yaxis_relay_mtics[$i] = $row[22];
    $sensor_ht_yaxis_temp_min[$i] = $row[23];
    $sensor_ht_yaxis_temp_max[$i] = $row[24];
    $sensor_ht_yaxis_temp_tics[$i] = $row[25];
    $sensor_ht_yaxis_temp_mtics[$i] = $row[26];
    $sensor_ht_yaxis_hum_min[$i] = $row[27];
    $sensor_ht_yaxis_hum_max[$i] = $row[28];
    $sensor_ht_yaxis_hum_tics[$i] = $row[29];
    $sensor_ht_yaxis_hum_mtics[$i] = $row[30];
    $sensor_ht_temp_relays_up[$i] = $row[31];
    $sensor_ht_temp_relays_down[$i] = $row[32];
    $pid_ht_temp_relay_high[$i] = $row[33];
    $pid_ht_temp_outmin_high[$i] = $row[34];
    $pid_ht_temp_outmax_high[$i] = $row[35];
    $pid_ht_temp_relay_low[$i] = $row[36];
    $pid_ht_temp_outmin_low[$i] = $row[37];
    $pid_ht_temp_outmax_low[$i] = $row[38];
    $pid_ht_temp_or[$i] = $row[39];
    $pid_ht_temp_set[$i] = $row[40];
    $pid_ht_temp_set_dir[$i] = $row[41];
    $pid_ht_temp_period[$i] = $row[42];
    $pid_ht_temp_p[$i] = $row[43];
    $pid_ht_temp_i[$i] = $row[44];
    $pid_ht_temp_d[$i] = $row[45];
    $sensor_ht_hum_relays_up[$i] = $row[46];
    $sensor_ht_hum_relays_down[$i] = $row[47];
    $pid_ht_hum_relay_high[$i] = $row[48];
    $pid_ht_hum_outmin_high[$i] = $row[49];
    $pid_ht_hum_outmax_high[$i] = $row[50];
    $pid_ht_hum_relay_low[$i] = $row[51];
    $pid_ht_hum_outmin_low[$i] = $row[52];
    $pid_ht_hum_outmax_low[$i] = $row[53];
    $pid_ht_hum_or[$i] = $row[54];
    $pid_ht_hum_set[$i] = $row[55];
    $pid_ht_hum_set_dir[$i] = $row[56];
    $pid_ht_hum_period[$i] = $row[57];
    $pid_ht_hum_p[$i] = $row[58];
    $pid_ht_hum_i[$i] = $row[59];
    $pid_ht_hum_d[$i] = $row[60];
    $i++;
}
if (!isset($sensor_ht_id)) $sensor_ht_id = [];
if (!isset($sensor_ht_graph)) $sensor_ht_graph = [];

unset($sensor_co2_id);
$results = $db->query('SELECT id,
                              name,
                              pin,
                              device,
                              period,
                              pre_measure_relay,
                              pre_measure_dur,
                              activated,
                              graph,
                              yaxis_relay_min,
                              yaxis_relay_max,
                              yaxis_relay_tics,
                              yaxis_relay_mtics,
                              yaxis_co2_min,
                              yaxis_co2_max,
                              yaxis_co2_tics,
                              yaxis_co2_mtics,
                              co2_relays_up,
                              co2_relays_down,
                              co2_relay_high,
                              co2_outmin_high,
                              co2_outmax_high,
                              co2_relay_low,
                              co2_outmin_low,
                              co2_outmax_low,
                              co2_or,
                              co2_set,
                              co2_set_direction,
                              co2_period,
                              co2_p,
                              co2_i,
                              co2_d
                       FROM   co2sensor');
$i = 0;
while ($row = $results->fetchArray()) {
    $sensor_co2_id[$i] = $row[0];
    $sensor_co2_name[$i] = $row[1];
    $sensor_co2_pin[$i] = $row[2];
    $sensor_co2_device[$i] = $row[3];
    $sensor_co2_period[$i] = $row[4];
    $sensor_co2_premeasure_relay[$i] = $row[5];
    $sensor_co2_premeasure_dur[$i] = $row[6];
    $sensor_co2_activated[$i] = $row[7];
    $sensor_co2_graph[$i] = $row[8];
    $sensor_co2_yaxis_relay_min[$i] = $row[9];
    $sensor_co2_yaxis_relay_max[$i] = $row[10];
    $sensor_co2_yaxis_relay_tics[$i] = $row[11];
    $sensor_co2_yaxis_relay_mtics[$i] = $row[12];
    $sensor_co2_yaxis_co2_min[$i] = $row[13];
    $sensor_co2_yaxis_co2_max[$i] = $row[14];
    $sensor_co2_yaxis_co2_tics[$i] = $row[15];
    $sensor_co2_yaxis_co2_mtics[$i] = $row[16];
    $sensor_co2_relays_up[$i] = $row[17];
    $sensor_co2_relays_down[$i] = $row[18];
    $pid_co2_relay_high[$i] = $row[19];
    $pid_co2_outmin_high[$i] = $row[20];
    $pid_co2_outmax_high[$i] = $row[21];
    $pid_co2_relay_low[$i] = $row[22];
    $pid_co2_outmin_low[$i] = $row[23];
    $pid_co2_outmax_low[$i] = $row[24];
    $pid_co2_or[$i] = $row[25];
    $pid_co2_set[$i] = $row[26];
    $pid_co2_set_dir[$i] = $row[27];
    $pid_co2_period[$i] = $row[28];
    $pid_co2_p[$i] = $row[29];
    $pid_co2_i[$i] = $row[30];
    $pid_co2_d[$i] = $row[31];
    $i++;
}
if (!isset($sensor_co2_id)) $sensor_co2_id = [];
if (!isset($sensor_co2_graph)) $sensor_co2_graph = [];

unset($sensor_press_id);
$results = $db->query('SELECT id,
                              name,
                              pin,
                              device,
                              period,
                              pre_measure_relay,
                              pre_measure_dur,
                              activated,
                              graph,
                              yaxis_relay_min,
                              yaxis_relay_max,
                              yaxis_relay_tics,
                              yaxis_relay_mtics,
                              yaxis_temp_min,
                              yaxis_temp_max,
                              yaxis_temp_tics,
                              yaxis_temp_mtics,
                              yaxis_press_min,
                              yaxis_press_max,
                              yaxis_press_tics,
                              yaxis_press_mtics,
                              temp_relays_up,
                              temp_relays_down,
                              temp_relay_high,
                              temp_outmin_high,
                              temp_outmax_high,
                              temp_relay_low,
                              temp_outmin_low,
                              temp_outmax_low,
                              temp_or,
                              temp_set,
                              temp_set_direction,
                              temp_period,
                              temp_p,
                              temp_i,
                              temp_d,
                              press_relays_up,
                              press_relays_down,
                              press_relay_high,
                              press_outmin_high,
                              press_outmax_high,
                              press_relay_low,
                              press_outmin_low,
                              press_outmax_low,
                              press_or,
                              press_set,
                              press_set_direction,
                              press_period,
                              press_p,
                              press_i,
                              press_d
                       FROM   presssensor');
$i = 0;
while ($row = $results->fetchArray()) {
    $sensor_press_id[$i] = $row[0];
    $sensor_press_name[$i] = $row[1];
    $sensor_press_pin[$i] = $row[2];
    $sensor_press_device[$i] = $row[3];
    $sensor_press_period[$i] = $row[4];
    $sensor_press_premeasure_relay[$i] = $row[5];
    $sensor_press_premeasure_dur[$i] = $row[6];
    $sensor_press_activated[$i] = $row[7];
    $sensor_press_graph[$i] = $row[8];
    $sensor_press_yaxis_relay_min[$i] = $row[9];
    $sensor_press_yaxis_relay_max[$i] = $row[10];
    $sensor_press_yaxis_relay_tics[$i] = $row[11];
    $sensor_press_yaxis_relay_mtics[$i] = $row[12];
    $sensor_press_yaxis_temp_min[$i] = $row[13];
    $sensor_press_yaxis_temp_max[$i] = $row[14];
    $sensor_press_yaxis_temp_tics[$i] = $row[15];
    $sensor_press_yaxis_temp_mtics[$i] = $row[16];
    $sensor_press_yaxis_press_min[$i] = $row[17];
    $sensor_press_yaxis_press_max[$i] = $row[18];
    $sensor_press_yaxis_press_tics[$i] = $row[19];
    $sensor_press_yaxis_press_mtics[$i] = $row[20];
    $sensor_press_temp_relays_up[$i] = $row[21];
    $sensor_press_temp_relays_down[$i] = $row[22];
    $pid_press_temp_relay_high[$i] = $row[23];
    $pid_press_temp_outmin_high[$i] = $row[24];
    $pid_press_temp_outmax_high[$i] = $row[25];
    $pid_press_temp_relay_low[$i] = $row[26];
    $pid_press_temp_outmin_low[$i] = $row[27];
    $pid_press_temp_outmax_low[$i] = $row[28];
    $pid_press_temp_or[$i] = $row[29];
    $pid_press_temp_set[$i] = $row[30];
    $pid_press_temp_set_dir[$i] = $row[31];
    $pid_press_temp_period[$i] = $row[32];
    $pid_press_temp_p[$i] = $row[33];
    $pid_press_temp_i[$i] = $row[34];
    $pid_press_temp_d[$i] = $row[35];
    $sensor_press_press_relays_up[$i] = $row[36];
    $sensor_press_press_relays_down[$i] = $row[37];
    $pid_press_press_relay_high[$i] = $row[38];
    $pid_press_press_outmin_high[$i] = $row[39];
    $pid_press_press_outmax_high[$i] = $row[40];
    $pid_press_press_relay_low[$i] = $row[41];
    $pid_press_press_outmin_low[$i] = $row[42];
    $pid_press_press_outmax_low[$i] = $row[43];
    $pid_press_press_or[$i] = $row[44];
    $pid_press_press_set[$i] = $row[45];
    $pid_press_press_set_dir[$i] = $row[46];
    $pid_press_press_period[$i] = $row[47];
    $pid_press_press_p[$i] = $row[48];
    $pid_press_press_i[$i] = $row[49];
    $pid_press_press_d[$i] = $row[50];
    $i++;
}
if (!isset($sensor_press_id)) $sensor_press_id = [];
if (!isset($sensor_press_graph)) $sensor_press_graph = [];

// conditional statements
unset($conditional_t_id);
for ($n = 0; $n < count($sensor_t_id); $n++) {
    $results = $db->query('SELECT id,
                                  name,
                                  state,
                                  sensor,
                                  direction,
                                  setpoint,
                                  period,
                                  sel_relay,
                                  relay,
                                  relay_state,
                                  relay_seconds_on,
                                  sel_command,
                                  do_command,
                                  sel_notify,
                                  do_notify
                           FROM   tsensorconditional  
                           WHERE  Sensor=' . $n);
    $i = 0;
    while ($row = $results->fetchArray()) {
        $conditional_t_id[$n][$i] = $row[0];
        $conditional_t_name[$n][$i] = $row[1];
        $conditional_t_state[$n][$i] = $row[2];
        $conditional_t_sensor[$n][$i] = $row[3];
        $conditional_t_direction[$n][$i] = $row[4];
        $conditional_t_setpoint[$n][$i] = $row[5];
        $conditional_t_period[$n][$i] = $row[6];
        $conditional_t_sel_relay[$n][$i] = $row[7];
        $conditional_t_relay[$n][$i] = $row[8];
        $conditional_t_relay_state[$n][$i] = $row[9];
        $conditional_t_relay_seconds_on[$n][$i] = $row[10];
        $conditional_t_sel_command[$n][$i] = $row[11];
        $conditional_t_command[$n][$i] = str_replace("''","'",$row[12]);
        $conditional_t_sel_notify[$n][$i] = $row[13];
        $conditional_t_notify[$n][$i] = $row[14];
        $i++;
    }
}

unset($conditional_ht_id);
for ($n = 0; $n < count($sensor_ht_id); $n++) {
    $results = $db->query('SELECT id,
                                  name,
                                  state,
                                  sensor,
                                  condition,
                                  direction,
                                  setpoint,
                                  period,
                                  sel_relay,
                                  relay,
                                  relay_state,
                                  relay_seconds_on,
                                  sel_command,
                                  do_command,
                                  sel_notify,
                                  do_notify
                           FROM   htsensorconditional  
                           WHERE  Sensor=' . $n);
    $i = 0;
    while ($row = $results->fetchArray()) {
        $conditional_ht_id[$n][$i] = $row[0];
        $conditional_ht_name[$n][$i] = $row[1];
        $conditional_ht_state[$n][$i] = $row[2];
        $conditional_ht_sensor[$n][$i] = $row[3];
        $conditional_ht_condition[$n][$i] = $row[4];
        $conditional_ht_direction[$n][$i] = $row[5];
        $conditional_ht_setpoint[$n][$i] = $row[6];
        $conditional_ht_period[$n][$i] = $row[7];
        $conditional_ht_sel_relay[$n][$i] = $row[8];
        $conditional_ht_relay[$n][$i] = $row[9];
        $conditional_ht_relay_state[$n][$i] = $row[10];
        $conditional_ht_relay_seconds_on[$n][$i] = $row[11];
        $conditional_ht_sel_command[$n][$i] = $row[12];
        $conditional_ht_command[$n][$i] = str_replace("''","'",$row[13]);
        $conditional_ht_sel_notify[$n][$i] = $row[14];
        $conditional_ht_notify[$n][$i] = $row[15];
        $i++;
    }
}

unset($conditional_co2_id);
for ($n = 0; $n < count($sensor_co2_id); $n++) {
    $results = $db->query('SELECT id,
                                  name,
                                  state,
                                  sensor,
                                  direction,
                                  setpoint,
                                  period,
                                  sel_relay,
                                  relay,
                                  relay_state,
                                  relay_seconds_on,
                                  sel_command,
                                  do_command,
                                  sel_notify,
                                  do_notify
                           FROM   co2sensorconditional  
                           WHERE  Sensor=' . $n);
    $i = 0;
    while ($row = $results->fetchArray()) {
        $conditional_co2_id[$n][$i] = $row[0];
        $conditional_co2_name[$n][$i] = $row[1];
        $conditional_co2_state[$n][$i] = $row[2];
        $conditional_co2_sensor[$n][$i] = $row[3];
        $conditional_co2_direction[$n][$i] = $row[4];
        $conditional_co2_setpoint[$n][$i] = $row[5];
        $conditional_co2_period[$n][$i] = $row[6];
        $conditional_co2_sel_relay[$n][$i] = $row[7];
        $conditional_co2_relay[$n][$i] = $row[8];
        $conditional_co2_relay_state[$n][$i] = $row[9];
        $conditional_co2_relay_seconds_on[$n][$i] = $row[10];
        $conditional_co2_sel_command[$n][$i] = $row[11];
        $conditional_co2_command[$n][$i] = str_replace("''","'",$row[12]);
        $conditional_co2_sel_notify[$n][$i] = $row[13];
        $conditional_co2_notify[$n][$i] = $row[14];
        $i++;
    }
}

unset($conditional_press_id);
for ($n = 0; $n < count($sensor_press_id); $n++) {
    $results = $db->query('SELECT id,
                                  name,
                                  state,
                                  sensor,
                                  condition,
                                  direction,
                                  setpoint,
                                  period,
                                  sel_relay,
                                  relay,
                                  relay_state,
                                  relay_seconds_on,
                                  sel_command,
                                  do_command,
                                  sel_notify,
                                  do_notify
                           FROM   presssensorconditional
                           WHERE  Sensor=' . $n);
    $i = 0;
    while ($row = $results->fetchArray()) {
        $conditional_press_id[$n][$i] = $row[0];
        $conditional_press_name[$n][$i] = $row[1];
        $conditional_press_state[$n][$i] = $row[2];
        $conditional_press_sensor[$n][$i] = $row[3];
        $conditional_press_condition[$n][$i] = $row[4];
        $conditional_press_direction[$n][$i] = $row[5];
        $conditional_press_setpoint[$n][$i] = $row[6];
        $conditional_press_period[$n][$i] = $row[7];
        $conditional_press_sel_relay[$n][$i] = $row[8];
        $conditional_press_relay[$n][$i] = $row[9];
        $conditional_press_relay_state[$n][$i] = $row[10];
        $conditional_press_relay_seconds_on[$n][$i] = $row[11];
        $conditional_press_sel_command[$n][$i] = $row[12];
        $conditional_press_command[$n][$i] = str_replace("''","'",$row[13]);
        $conditional_press_sel_notify[$n][$i] = $row[14];
        $conditional_press_notify[$n][$i] = $row[15];
        $i++;
    }
}

// Sort sensor Presets
$sensor_t_preset = [];
$results = $db->query('SELECT id FROM tsensorpreset');
while ($row = $results->fetchArray()) {
    $sensor_t_preset[] = $row[0];
}
sort($sensor_t_preset, SORT_NATURAL | SORT_FLAG_CASE);

$sensor_ht_preset = [];
$results = $db->query('SELECT id FROM htsensorpreset');
while ($row = $results->fetchArray()) {
    $sensor_ht_preset[] = $row[0];
}
sort($sensor_ht_preset, SORT_NATURAL | SORT_FLAG_CASE);

$sensor_co2_preset = [];
$results = $db->query('SELECT id FROM co2sensorpreset');
while ($row = $results->fetchArray()) {
    $sensor_co2_preset[] = $row[0];
}
sort($sensor_co2_preset, SORT_NATURAL | SORT_FLAG_CASE);

$sensor_press_preset = [];
$results = $db->query('SELECT id FROM presssensorpreset');
while ($row = $results->fetchArray()) {
    $sensor_press_preset[] = $row[0];
}
sort($sensor_press_preset, SORT_NATURAL | SORT_FLAG_CASE);

unset($timer_id);
$results = $db->query('SELECT id,
                              name,
                              state,
                              relay,
                              durationon,
                              durationoff
                       FROM   timers');
$i = 0;
while ($row = $results->fetchArray()) {
    $timer_id[$i] = $row[0];
    $timer_name[$i] = $row[1];
    $timer_state[$i] = $row[2];
    $timer_relay[$i] = $row[3];
    $timer_duration_on[$i] = $row[4];
    $timer_duration_off[$i] = $row[5];
    $i++;
}
if (!isset($timer_id)) $timer_id = [];

unset($timer_daily_id);
$results = $db->query('SELECT id,
                              name,
                              state,
                              relay,
                              houron,
                              minuteon,
                              durationon
                       FROM   timers_daily');
$i = 0;
while ($row = $results->fetchArray()) {
    $timer_daily_id[$i] = $row[0];
    $timer_daily_name[$i] = $row[1];
    $timer_daily_state[$i] = $row[2];
    $timer_daily_relay[$i] = $row[3];
    $timer_daily_hour_on[$i] = $row[4];
    $timer_daily_minute_on[$i] = $row[5];
    $timer_daily_duration_on[$i] = $row[6];
    $i++;
}
if (!isset($timer_daily_id)) $timer_daily_id = [];

$results = $db->query('SELECT combined_temp_min,
                              combined_temp_max,
                              combined_temp_tics,
                              combined_temp_mtics,
                              combined_temp_relays_up,
                              combined_temp_relays_down,
                              combined_temp_relays_min,
                              combined_temp_relays_max,
                              combined_temp_relays_tics,
                              combined_temp_relays_mtics,
                              combined_hum_min,
                              combined_hum_max,
                              combined_hum_tics,
                              combined_hum_mtics,
                              combined_hum_relays_up,
                              combined_hum_relays_down,
                              combined_hum_relays_min,
                              combined_hum_relays_max,
                              combined_hum_relays_tics,
                              combined_hum_relays_mtics,
                              combined_co2_min,
                              combined_co2_max,
                              combined_co2_tics,
                              combined_co2_mtics,
                              combined_co2_relays_up,
                              combined_co2_relays_down,
                              combined_co2_relays_min,
                              combined_co2_relays_max,
                              combined_co2_relays_tics,
                              combined_co2_relays_mtics,
                              combined_press_min,
                              combined_press_max,
                              combined_press_tics,
                              combined_press_mtics,
                              combined_press_relays_up,
                              combined_press_relays_down,
                              combined_press_relays_min,
                              combined_press_relays_max,
                              combined_press_relays_tics,
                              combined_press_relays_mtics
                       FROM   customgraph');
while ($row = $results->fetchArray()) {
    $combined_temp_min = $row[0];
    $combined_temp_max = $row[1];
    $combined_temp_tics = $row[2];
    $combined_temp_mtics = $row[3];
    $combined_temp_relays_up = $row[4];
    $combined_temp_relays_down = $row[5];
    $combined_temp_relays_min = $row[6];
    $combined_temp_relays_max = $row[7];
    $combined_temp_relays_tics = $row[8];
    $combined_temp_relays_mtics = $row[9];
    $combined_hum_min = $row[10];
    $combined_hum_max = $row[11];
    $combined_hum_tics = $row[12];
    $combined_hum_mtics = $row[13];
    $combined_hum_relays_up = $row[14];
    $combined_hum_relays_down = $row[15];
    $combined_hum_relays_min = $row[16];
    $combined_hum_relays_max = $row[17];
    $combined_hum_relays_tics = $row[18];
    $combined_hum_relays_mtics = $row[19];
    $combined_co2_min = $row[20];
    $combined_co2_max = $row[21];
    $combined_co2_tics = $row[22];
    $combined_co2_mtics = $row[23];
    $combined_co2_relays_up = $row[24];
    $combined_co2_relays_down = $row[25];
    $combined_co2_relays_min = $row[26];
    $combined_co2_relays_max = $row[27];
    $combined_co2_relays_tics = $row[28];
    $combined_co2_relays_mtics = $row[29];
    $combined_press_min = $row[30];
    $combined_press_max = $row[31];
    $combined_press_tics = $row[32];
    $combined_press_mtics = $row[33];
    $combined_press_relays_up = $row[34];
    $combined_press_relays_down = $row[35];
    $combined_press_relays_min = $row[36];
    $combined_press_relays_max = $row[37];
    $combined_press_relays_tics = $row[38];
    $combined_press_relays_mtics = $row[39];
}

$results = $db->query('SELECT host,
                              ssl,
                              port,
                              user,
                              pass,
                              email_from,
                              wait_time
                       FROM   smtp');
while ($row = $results->fetchArray()) {
    $smtp_host = $row[0];
    $smtp_ssl = $row[1];
    $smtp_port = $row[2];
    $smtp_user = $row[3];
    $smtp_pass = $row[4];
    $smtp_email_from = $row[5];
    $smtp_wait_time = $row[6];
}

$results = $db->query('SELECT relay,
                              timestamp,
                              display_last,
                              cmd_pre,
                              cmd_post,
                              extra_parameters
                       FROM   camerastill');
while ($row = $results->fetchArray()) {
    $still_relay = $row[0];
    $still_timestamp = $row[1];
    $still_display_last = $row[2];
    $still_cmd_pre = str_replace("''","'",$row[3]);
    $still_cmd_post = str_replace("''","'",$row[4]);
    $still_extra_parameters = str_replace("''","'",$row[5]);
}

$results = $db->query('SELECT relay,
                              cmd_pre,
                              cmd_post,
                              extra_parameters
                       FROM   camerastream');
while ($row = $results->fetchArray()) {
    $stream_relay = $row[0];
    $stream_cmd_pre = str_replace("''","'",$row[1]);
    $stream_cmd_post = str_replace("''","'",$row[2]);
    $stream_extra_parameters = str_replace("''","'",$row[3]);
}

$results = $db->query('SELECT relay,
                              path,
                              prefix,
                              file_timestamp,
                              display_last,
                              cmd_pre,
                              cmd_post,
                              extra_parameters
                       FROM   cameratimelapse');
while ($row = $results->fetchArray()) {
    $timelapse_relay = $row[0];
    $timelapse_path = $row[1];
    $timelapse_prefix = $row[2];
    $timelapse_timestamp = $row[3];
    $timelapse_display_last = $row[4];
    $timelapse_cmd_pre = str_replace("''","'",$row[5]);
    $timelapse_cmd_post = str_replace("''","'",$row[6]);
    $timelapse_extra_parameters = str_replace("''","'",$row[7]);
}

$results = $db->query('SELECT login_message,
                              refresh_time,
                              enable_max_amps,
                              max_amps,
                              relay_stats_volts,
                              relay_stats_cost,
                              relay_stats_currency,
                              relay_stats_dayofmonth
                       FROM   misc');
while ($row = $results->fetchArray()) {
    $login_message = $row[0];
    $refresh_time = $row[1];
    $enable_max_amps = $row[2];
    $max_amps = $row[3];
    $relay_stats_volts = $row[4];
    $relay_stats_cost = $row[5];
    $relay_stats_currency = $row[6];
    $relay_stats_dayofmonth = $row[7];
}
