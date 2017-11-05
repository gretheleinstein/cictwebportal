<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LinkedPila;
use App\LinkedFloorFour;
use App\LinkedFloorThree;
use App\LinkedSetting;


class Student extends Controller
{
    //--------------------------------------------------------------------------
    public function check_number($cict_id /*Request $request*/)
    {
        //$post = $request->all();
        // student cict_id
        $id = $cict_id; //$post['id'];

        // check for pila information
        // only non void should be fetch
        $student_pila = LinkedPila::where('active', '1')
            ->where('status', '!=', 'VOID')
            ->where('STUDENT_id', $id)
            ->orderBy('id', 'DESC')
            ->first();

        if (!$student_pila) {
            $end_reply['pila_status'] = "no";
            print json_encode($end_reply,JSON_FORCE_OBJECT);
            exit();
        }

        $floor_assignment = $student_pila->floor_assignment;
        $current_called = "";
        if ($floor_assignment == '3') {
            $floor_info = LinkedFloorThree::where('pila_id', $student_pila->id)
                ->first();
            $current_called = $this->get_current('3');
        } else if ($floor_assignment == '4') {
            $floor_info = LinkedFloorFour::where('pila_id', $student_pila->id)
                ->first();
            $current_called = $this->get_current('4');
        } else {
            $floor_info['id'] = "NO_ROOM_ASSIGNED";
            $floor_info['pila_id'] = "NONE";
        }

        $linked_settings = LinkedSetting::where('id', $student_pila->SETTINGS_id)
            ->first();

        //$pila_reference =
        $reply['pila_status'] = "yes";
        $reply['pila_info'] = $student_pila;
        $reply['reference'] = $floor_info;
        $reply['called'] = $current_called;
        $reply['settings'] = $linked_settings;
        echo json_encode($reply, JSON_FORCE_OBJECT);
    }

    //--------------------------------------------------------------------------
    private function get_current($floor)
    {
        $pila = LinkedPila::where('active', '1')
            ->where('status', 'CALLED')
            ->where('floor_assignment', $floor)
            ->orderBy('id', 'DESC')
            ->first();

        if (!$pila) {
            return "Waiting";
        }

        /*
        Refractored fixed assignment to equality = -> == @date 09/01/2017
        */
        if ($floor == '3') {
            $floor_info = LinkedFloorThree::where('pila_id', $pila->id)
                ->first();
        } else if ($floor == '4') {
            $floor_info = LinkedFloorFour::where('pila_id', $pila->id)
                ->first();
        }

        return $floor_info->id;


    }

    //------------------------------------------------------------------

    public function cancel_reference(Request $request)
    {
        $post = $request->all();
        $pila_id = $post['pila_id'];

        $pila_reference = LinkedPila::where('id', $pila_id)
            ->first();

        $pila_reference->status = "VOID";
        $res = $pila_reference->save();

        if ($res) {
            $reply['res'] = "ok";
            echo json_encode($reply, JSON_FORCE_OBJECT);
        } else {
            $reply['res'] = "failed";
            echo json_encode($reply, JSON_FORCE_OBJECT);
        }

    }

}
