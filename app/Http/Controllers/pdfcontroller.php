<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToText\pdf;

class pdfcontroller extends Controller
{
    public function convertidorpdf(Request $request){
        $request->validate([
            'pdf_files.*' => 'required|mimes:pdf|max:10240', 
        ], [
             'pdf_files.*.required' => 'El archivo PDF es requerido.',
             'pdf_files.*.mimes' => 'Todos los archivos deben ser de tipo PDF.',
        ]);
    
        
        $texts = [];
        foreach ($request->file('pdf_files') as $pdfFile) {
            $pdfPath = $pdfFile->store('pdfs'); 
            $texts[] = Pdf::getText(storage_path("app/{$pdfPath}"), 'C:/Program Files/Git/mingw64/bin/pdftotext');
        }
    
        return view('upload', ['texts' => $texts])
            ->with('success', 'Archivos PDF procesados con éxito');
    }


    public function convertidor(Request $request){
        
        $request->validate([
            'pdf_files.*' => 'required|mimes:pdf|max:10240', 
        ], [
             'pdf_files.*.required' => 'El archivo PDF es requerido.',
             'pdf_files.*.mimes' => 'Todos los archivos deben ser de tipo PDF.',
        ]);
    
        $texts = [];
        $pdfFile = $request->file('pdf_files');
        $pdfPath = $pdfFile->store('pdfs'); 
        $texts = Pdf::getText(storage_path("app/{$pdfPath}"), 'C:/Program Files/Git/mingw64/bin/pdftotext');
        
        return  $texts;
    }
}
