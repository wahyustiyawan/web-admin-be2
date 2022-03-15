<?php

use App\Http\Controllers\API\AdministrationController;
use App\Models\Kelas;

use App\Http\Controllers\API\KelasController;
use App\Http\Controllers\API\EnrollMataKuliahController;
use App\Http\Controllers\API\EnrollStudiController;
use App\Http\Controllers\API\KontenDokumenController;
use App\Http\Controllers\API\KontenVideoController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\KalenderController;
use App\Http\Controllers\API\UserVideoController;
use App\Http\Controllers\API\UserDokumenController;
use App\Http\Controllers\API\UserAssignmentController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\DownloadController;
use App\Http\Controllers\API\MataKuliahController;
use App\Http\Controllers\API\PertemuanController;
use App\Http\Controllers\API\QuizController;
use App\Http\Controllers\API\UserQuizController;
use App\Http\Controllers\API\NilaiController;
use App\Http\Controllers\API\UserExamPGController;
use App\Http\Controllers\API\ViewController;
use App\Http\Controllers\API\ArtikelController;
use App\Http\Controllers\API\IklanController;
use App\Http\Controllers\API\JobChannelController;
use App\Http\Controllers\API\ProfilController;
use App\Http\Controllers\API\AssignmentController;
use App\Http\Controllers\API\AssignmentFileController;
use App\Http\Controllers\API\AssignmentPilganController;
use App\Http\Controllers\API\AssignmentTextController;
use App\Http\Controllers\API\DiscussionForumController;
use App\Http\Controllers\API\DiscussionReplyController;
use App\Http\Controllers\API\DiscussionReply2Controller;
use App\Http\Controllers\API\DiscussionLikeController;
use App\Http\Controllers\API\DiscussionLike2Controller;
use App\Http\Controllers\API\ExamController;
use App\Http\Controllers\API\LeaderboardController;
use App\Http\Controllers\API\TranskipController;
use App\Http\Controllers\API\UserExamController;
use App\Http\Controllers\API\UserJobChannelController;
use App\Http\Controllers\API\UserMandiriController;
use App\Http\Controllers\API\SertifikatController;
use App\Http\Controllers\API\GuideController;
use App\Http\Controllers\API\ProgramController;
use App\Models\DiscussionForum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/ 
Route::put('/administrasi/{id}', [AdministrationController::class, 'update']);
// Public routes
Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/registration', [PassportAuthController::class, 'apiRegist']);
Route::post('/login', [PassportAuthController::class, 'login']);

// Program
Route::get('/getProgram', [ProgramController::class, 'index']);
Route::post('/program', [ProgramController::class, 'store']);
Route::put('/program/{id}', [ProgramController::class, 'update']);
Route::delete('/program/{id}', [ProgramController::class, 'destroy']);

// Route progam studi
Route::get('/kelas', [KelasController::class, 'index']);
Route::get('/kelas/{id}', [KelasController::class, 'show']);
Route::get('/kelas/search/{name}', [KelasController::class, 'search']);
Route::get('/kelas/{id}/video', [KelasController::class, 'kelas_video']);
Route::get('/kelas/{id}/dokumen', [KelasController::class, 'kelas_dokumen']);
Route::post('/kelas/{id}/video', [KontenVideoController::class, 'store']);
Route::post('/kelas/{id}/dokumen', [KontenDokumenController::class, 'store']);
// Route::get('/kelas/search/{name}', [KelasController::class, 'search']);

// Route kategori
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/{id}', [KategoriController::class, 'show']);
Route::get('/kategori/search/{name}', [KategoriController::class, 'search']);
Route::get('/kategori/{id}/video', [KategoriController::class, 'kelas_video']);
Route::get('/kategori/{id}/dokumen', [KategoriController::class, 'kelas_dokumen']);

// Route mata kuliah
Route::get('/mata-kuliah', [MataKuliahController::class, 'index']);
Route::get('/mata-kuliah/{id}', [MataKuliahController::class, 'findbyid']);

// Route konten dokumen
Route::get('/dokumen', [KontenDokumenController::class, 'index']);
Route::get('/dokumen/{id}', [KontenDokumenController::class, 'show']);
Route::get('/dokumen/search/{name}', [KontenDokumenController::class, 'search']);
Route::get('/kelas/{id}/dokumen/jumlah', [KontenDokumenController::class, 'jumlah_dokumen']);

// Route konten video
Route::get('/video', [KontenVideoController::class, 'index']);
Route::get('/video/{id}', [KontenVideoController::class, 'show']);
Route::get('/video/search/{name}', [KontenVideoController::class, 'search']);
Route::get('/kelas/{id}/video/jumlah', [KontenVideoController::class, 'jumlah_video']);

//Route Artikel
Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/show/{id}', [ArtikelController::class, 'show']);
Route::get('/artikel/search/{judul}', [ArtikelController::class, 'search']);
Route::post('/artikel/store', [ArtikelController::class, 'store']);
Route::put('artikel/update/{id}', [ArtikelController::class, 'update']);
Route::delete('artikel/delete/{id}', [ArtikelController::class, 'destroy']);
Route::get('/artikel/new', [ArtikelController::class, 'latest_article']);

//Route Iklan
Route::get('/iklan', [IklanController::class, 'index']);
Route::post('/iklan', [IklanController::class, 'store']);
Route::get('/iklan/{id}', [IklanController::class, 'show']);
Route::get('/iklan/{id}/download', [IklanController::class, 'download']);
Route::get('/iklan/{id}/view', [IklanController::class, 'view']);
Route::resource('iklan', IklanController::class);

//Route JobChannel
Route::get('/job_kerja', [JobChannelController::class, 'job_kerja']);
Route::get('/job_magang', [JobChannelController::class, 'job_magang']);
Route::get('/job_project', [JobChannelController::class, 'job_project']);
Route::get('/jobChannel', [JobChannelController::class, 'index']);
Route::post('/jobChannel', [JobChannelController::class, 'store']);
Route::get('/jobChannel/{id}', [JobChannelController::class, 'show']);
Route::get('/jobChannel/{id}/download', [JobChannelController::class, 'download']);
Route::get('/jobChannel/{id}/view', [JobChannelController::class, 'view']);



//Route Quiz
Route::get('/quiz', [QuizController::class, 'index']);
Route::get('/Pertemuan', [QuizController::class, 'Pertemuan']);
Route::get('/quiz/{id}', [QuizController::class, 'show']);

//User Quiz
Route::get('/user-quiz', [UserQuizController::class, 'index']);

//User ExamPG
Route::post('/user-exampg', [UserExamPGController::class, 'store']);

//Route Assignment
Route::get('/assignment', [AssignmentController::class, 'index']);
Route::get('/assignment/{id}/download', [AssignmentController::class, 'download']);
Route::get('/assignment/{id}/view', [AssignmentController::class, 'view']);
Route::get('/assignment/{id}', [AssignmentController::class, 'show']);

//Route Exam
Route::get('/exam', [ExamController::class, 'index']);
Route::post('/exam', [ExamController::class, 'store']);
Route::get('/exam/{id}/download', [ExamController::class, 'download']);
Route::get('/exam/{id}/view', [ExamController::class, 'view']);
Route::get('/exam/{id}', [ExamController::class, 'show']);

//User Assignment
Route::get('/userAssignment', [UserAssignmentController::class, 'index']);

Route::get('/userAssignment/show/{id}', [UserAssignmentController::class, 'show']);



//Leaderboard
Route::get('/leaderboard', [LeaderboardController::class, 'index']);

//DiscussionForum
Route::get('/discussionForum', [DiscussionForumController::class, 'index']);
Route::post('/discussionForum', [DiscussionForumController::class, 'store']);
Route::delete('/discussionForum/destroy/{id}', [DiscussionForumController::class, 'destroy']);

//DiscussionReply
Route::get('/discussionReply/{id}', [DiscussionReplyController::class, 'index']);
Route::delete('/discussionReply/destroy/{id}', [DiscussionReplyController::class, 'destroy']);

//DiscussionReply2
Route::get('/discussionReply2/{id}', [DiscussionReply2Controller::class, 'index']);
Route::delete('/discussionReply2/destroy/{id}', [DiscussionReply2Controller::class, 'destroy']);

//DiscussionLike
Route::get('/discussionLike/{id}', [DiscussionLikeController::class, 'index']);
Route::delete('/discussionLike/destroy/{id}', [DiscussionLikeController::class, 'destroy']);

//DiscussionLike2
Route::get('/discussionLike2', [DiscussionLike2Controller::class, 'index']);
Route::delete('/discussionLike2/destroy/{id}', [DiscussionLike2Controller::class, 'destroy']);

//DiscussionLike2
Route::get('/discussionLike3', [DiscussionLike3Controller::class, 'index']);
Route::delete('/discussionLike3/destroy/{id}', [DiscussionLike3Controller::class, 'destroy']);

//Route Assignment Pilgan
Route::get('assignmentPilgan', [AssignmentPilganController::class, 'index']);
Route::get('assignmentPilgan/{mata_kuliah}/{pertemuan}', [AssignmentPilganController::class, 'show']);

//Route Assignment Text
Route::get('/assignmentText', [AssignmentFileController::class, 'index']);

// Download and view Route
Route::get('download/{tipe}/{filename}', [DownloadController::class, 'index']);
Route::get('/dokumen/{id}/download', [KontenDokumenController::class, 'download']);
Route::get('/dokumen/{id}/view', [KontenDokumenController::class, 'view']);
Route::get('view/{filename}', [ViewController::class, 'index']);
Route::get('view2/{filename}', [ViewController::class, 'index2']);
Route::get('/mata-kuliah', [MataKuliahController::class, 'index']);
Route::get('/mata-kuliah/{id}', [MataKuliahController::class, 'findbyid']);
Route::get('/kalender', [KalenderController::class, 'index']);

// Route Jumlah Mahasiswa
Route::get('/jumlah-enroll/{id}', [EnrollStudiController::class, 'enroll']);
Route::get('/jumlah-enroll-matkul/{id}', [EnrollMataKuliahController::class, 'enroll']);

//E-Guide
Route::get('/buku_panduan', [GuideController::class, 'buku_panduan']);
Route::get('/video_panduan', [GuideController::class, 'video_panduan']);
Route::get('/kamus_kg', [GuideController::class, 'kamus_kg']);
Route::get('/view3/{file_name}', [ViewController::class, 'view_buku_panduan']);
Route::get('/getAdministrasi', [AdministrationController::class, 'getAdministrasi'])->name('getAdministrasi');

// Protected routes
Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/sertifikat', [SertifikatController::class, 'sertifikat']);  
    //User Job Channel
    Route::post('/userjobchannel', [UserJobChannelController::class, 'store']);
    
    Route::put('/updateAdministrasi', [AdministrationController::class, 'updateAdministrasi'])->name('updateAdministrasi');
    
    //Transkip
    Route::get('/transkip', [TranskipController::class, 'index']);
    Route::get('/transkip/semester/{semester}', [TranskipController::class, 'transkipSemester']);
    
    //DiscussionForum
    Route::post('/discussionForum', [DiscussionForumController::class, 'store']);
    Route::put('/discussionForum/update/{id}', [DiscussionForumController::class, 'update']);

    //DiscussionReply
    Route::post('/discussionReply', [DiscussionReplyController::class, 'store']);
    Route::put('/discussionReply/update/{id}', [DiscussionReplyController::class, 'update']);

    //DiscussionReply2
    Route::post('/discussionReply2', [DiscussionReply2Controller::class, 'store']);
    Route::put('/discussionReply2/update/{id}', [DiscussionReply2Controller::class, 'update']);

    //DiscussionLike
    Route::post('/discussionLike', [DiscussionLikeController::class, 'store']);
    Route::put('/discussionLike/update/{id}', [DiscussionLikeController::class, 'update']);

    //DiscussionLike2
    Route::post('/discussionLike2', [DiscussionLike2Controller::class, 'store']);
    Route::put('/discussionLike2/update/{id}', [DiscussionLike2Controller::class, 'update']);
 
    //DiscussionLike3
    Route::post('/discussionLike3', [DiscussionLike3Controller::class, 'store']);
    Route::put('/discussionLike3/update/{id}', [DiscussionLike3Controller::class, 'update']);

    //Route Profil
    Route::get('/profil', [ProfilController::class, 'index']);
    Route::post('/profil', [ProfilController::class, 'store']);
    Route::get('/profil/{id}', [ProfilController::class, 'show']);
    Route::get('/profil/{id}/view', [PofilController::class, 'view']);
    
    Route::put('/enroll/video/{id}', [UserVideoController::class, 'update']);
    Route::put('/enroll/dokumen/{id}', [UserDokumenController::class, 'update']);
    Route::get('/enroll', [EnrollStudiController::class, 'index']);
    Route::get('/enroll/mata-kuliah', [EnrollMataKuliahController::class, 'index']);
    Route::get('enroll/video', [EnrollMataKuliahController::class, 'enrolled_video']);
    Route::get('enroll/dokumen', [EnrollMataKuliahController::class, 'enrolled_dokumen']);
    Route::get('/enroll/{id}', [EnrollMataKuliahController::class, 'findbyid']);
    Route::post('/enroll', [EnrollStudiController::class, 'store']);
    Route::delete('/unenroll/{id}', [EnrollStudiController::class, 'unenrolls']);
    Route::delete('/unenroll', [EnrollStudiController::class, 'unenrollsbykelasid']);
    Route::get('/pertemuan', [PertemuanController::class, 'index']);
    Route::get('/pertemuan/{id}', [PertemuanController::class, 'findbyid']);
    Route::get('/user-details', [PassportAuthController::class, 'userDetail']);
    Route::put('/user-details', [PassportAuthController::class, 'updateuserDetail']);
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::put('/kelas/{id}', [KelasController::class, 'update']);
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::put('/dokumen/{id}', [KontenDokumenController::class, 'update']);
    Route::delete('/dokumen/{id}', [KontenDokumenController::class, 'destroy']);

    Route::put('/video/{id}', [KontenVideoController::class, 'update']);
    Route::delete('/video/{id}', [KontenVideoController::class, 'destroy']);

    //User Assignment
    Route::post('/userAssignment', [UserAssignmentController::class, 'store']); 
    
    // User Mandiri
    Route::post('/userMandiri', [UserMandiriController::class, 'store']); 

    // Route User Exam
    Route::get('/userExam', [UserExamController::class, 'index']);
    Route::post('/userExam', [UserExamController::class, 'store']);
    Route::get('/userExam/{id}', [UserExamController::class, 'show']);

    //Route Nilai
    // Route::post('/nilaiQuiz', [NilaiController::class, 'nilaiQuiz']);
    Route::get('/gradeAssignment/{id}', [NilaiController::class, 'gradeAssignment']);
    Route::get('/gradeUts/{id}', [NilaiController::class, 'gradeUts']);
    Route::get('/gradeUas/{id}', [NilaiController::class, 'gradeUas']);
    Route::get('/gradeQuiz/{id}', [NilaiController::class, 'gradeQuiz']);
    
    //Route Quiz
    Route::post('/user-quiz', [UserQuizController::class, 'store']);
    Route::post('/nilai-quiz', [UserQuizController::class, 'nilaiQuiz']);

    Route::get('nilai-akhir/{matkul}', [NilaiController::class, 'nilaiAkhir']);

});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
