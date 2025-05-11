<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NoticeBoardModel;
use App\Models\NoticeBoardMessageModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CommunicateController extends Controller
{
    public function noticeBoard()
    {
        $data['getRecord'] = NoticeBoardModel::getRecord();
        return view('admin.communicate.notice_board.list', $data);
    }
    public function addNoticeBoard()
    {

        $data['header_title' ]= 'Add notice board';
        return view('admin.communicate.notice_board.add', $data);
    }
    public function insertNoticeBoard(Request $request)
    {
        $noticeBoard = new NoticeBoardModel;
        $noticeBoard->title = trim($request->title);
        $noticeBoard->notice_date = trim($request->notice_date);
        $noticeBoard->publish_date = trim($request->publish_date);
        $noticeBoard->message = trim($request->message);
        $noticeBoard->created_by = Auth::user()->id;
        $noticeBoard->save();
       if(!empty($request->message_to)){
        foreach ($request->message_to as $message_to) {
            $message = new NoticeBoardMessageModel;
            $message->notice_board_id = $noticeBoard->id;
            $message->message_to = $message_to;
            $message->save();
        }
       }
        return redirect('admin/communicate/notice_board')->with('success', 'Notice board added successfully');
    }

    public function editNoticeBoard( $id)
    {
        $data['getRecord'] = NoticeBoardModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title' ]= 'Edit notice board';
            return view('admin.communicate.notice_board.edit', $data);
        } else {
            abort(404);
        }

    }

    public function updateNoticeBoard($id, Request $request)
    {
        $noticeBoard=  NoticeBoardModel::getSingle($id);
        $noticeBoard->title = trim($request->title);
        $noticeBoard->notice_date = trim($request->notice_date);
        $noticeBoard->publish_date = trim($request->publish_date);
        $noticeBoard->message = trim($request->message);
        $noticeBoard->save();
        NoticeBoardMessageModel::deleteRecord($id);
       if(!empty($request->message_to)){
        foreach ($request->message_to as $message_to) {
            $message = new NoticeBoardMessageModel;
            $message->notice_board_id = $noticeBoard->id;
            $message->message_to = $message_to;
            $message->save();
        }
       }

        $noticeBoard->save();
        return redirect('admin/communicate/notice_board')->with('success', 'Notice board updated successfully');

    }

    public function deleteNoticeBoard($id)
    {
        $noticeBoard = NoticeBoardModel::getSingle($id);
        if (!empty($noticeBoard)) {

            $noticeBoard->delete();
            return redirect()->back()->with('success', 'Notice board deleted successfully');
        } else {
            abort(404);
        }
    }

// student menu
    public function myNoticeBoardStudent()
    {
        $data['getRecord'] = NoticeBoardModel::getRecordUser(Auth::getUser()->role);
        return view('student.my_notice_board', $data);
    }
}
