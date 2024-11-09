<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function previewCertificate(Student $student)
    {
        $admin = User::where('role', 'admin')->first();

        $pdf = Pdf::loadView('certificate', compact('student', 'admin'))
              ->setPaper('a4', 'landscape');

        return $pdf->stream("Certificado_{$student->name}.pdf");
    }
}
