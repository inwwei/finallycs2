<?php

namespace App\Http\Controllers;

use App\Models\Attached;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttachedController extends Controller
{
    public function show($attachedable_id)
    {
        $attached = Attached::where('attachedable_id', $attachedable_id)->orderBy('created_at')->get();
        return response()->success($attached);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'model' => 'required',
        ]);

        try {
            $model_name = $request->model;
            $data =  $model_name::find($request->id);
            $temp = $data;
        } catch (\Throwable $th) {
            return response()->error(['ไม่พบข้อมูลที่ต้องการ'], '40');
        }

        if (!$data) {
            return response()->error(['ไม่พบข้อมูลที่ต้องการ'], '40');
        }

        $ans = [];
        foreach ($request->input('files') as $index => $item) {
            if (!$request->hasFile("files.{$index}.file")) {
                continue;
            }
            $path = $request->file("files.{$index}.file")->store('avatars');
            $file = $request->file("files.{$index}.file");
            // $path = Storage::putFile('avatars', $file['file']);

            $attached = [
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'full_path' => Storage::url($path),
                'mime_type' => $file->getClientMimeType(),
                'type' => $this->genType($file->getClientMimeType()),
                'width',
                'height',
                'src' => '',
                'alt' => '',
                'description' => '',
            ];

            //กรณี type เป็น image จะหาค่า width,height ด้วย
            if ($attached['type'] == 'image') {
                $full_path = Storage::path($path);
                $info = getimagesize($full_path);
                list($w, $h) = $info;
                $attached['width'] = $w;
                $attached['height'] = $h;
            }

            if ($data) {
                $attached = $data->attacheds()->create($attached);
            } else {
                return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
            }

            array_push($ans, $attached);
        }
        return response()->success($ans);
    }

    public function destroy($id)
    {
        $attached = Attached::find($id);
        if (!$attached) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
        $result = $attached->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return response()->success($attached->toArray(), [], '0', 200);
    }

    /**
     * Type ไว้แยกประเภทไฟล์ตอนจะแสดงที่ frontend
     *  Result
     *      video       ไฟล์วิดิโอ
     *      audio       ไฟล์เสียง
     *      image       ไฟล์รูป
     *      pdf         ไฟล์ PDF
     *      file        ไฟล์อื่นๆ ที่ไม่เข้าพวกทั้งหมด
     *
     * @param string $mime      ค่า mime แบบเต็มจาก getClientMimeType
     * @return string
     */
    private function genType($mime)
    {
        if (strpos($mime, 'video') !== false) {
            return 'video';
        } else if (strpos($mime, 'audio') !== false) {
            return 'audio';
        } else if (strpos($mime, 'image') !== false) {
            return 'image';
        } else if (strpos($mime, 'pdf') !== false) {
            return 'pdf';
        } else {
            return 'file';
        }
    }
}
