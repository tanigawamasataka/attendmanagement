<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;

class Export implements FromView, WithEvents
{

    private $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function registerEvents() : array
    {
        return [
            BeforeSheet::class => function(BeforeSheet $event) {
                $sheet = $event->getSheet()->getDelegate();
                //セルの幅指定
                $width = ['A' => 10, 'B' => 8,'C' => 7,'D' => 12,'E' => 11, 
                          'F' => 11,'G' => 11,'H' => 11,'I' => 11,'J' => 15,'K' => 11,];
                // Disable the autosize and set column width
                foreach ($width as $column => $value) {
                    $sheet->getColumnDimension($column)
                        ->setAutoSize(false)
                        ->setWidth($value);
                }
                // Set autosized to true
                $sheet->hasFixedSizeColumns = true;

                //セルの高さ指定
                $sheet = $event->getSheet()->getDelegate();
                $sheet->getDefaultRowDimension()->setRowHeight(17);

                //枠線の指定

                //Top,medium
                $cells = ['B2:C2', 'F2:K2'];
                foreach($cells as $cell)
                {
                    $borders = $sheet->getStyle($cell)->getBorders();
                    $borders->getTop()->setBorderStyle('medium');
                }
                
                //Left,medium
                $cells = ['B2:B38', 'J2:J4', 'K5:K38'];
                foreach($cells as $cell)
                {
                    $borders = $sheet->getStyle($cell)->getBorders();
                    $borders->getLeft()->setBorderStyle('medium');
                }

                //Right,medium
                $cells = ['K2:K38', 'D2:D4', 'C5:C38', 'I5:I38'];
                foreach($cells as $cell)
                {
                    $borders = $sheet->getStyle($cell)->getBorders();
                    $borders->getRight()->setBorderStyle('medium');
                }
               
                //Right,thin
                $cells = ['B5:B38', 'D6:D38', 'E6:E38', 'F6:F38', 'G6:G38', 'H6:H38'];
                foreach($cells as $cell)
                {
                    $borders = $sheet->getStyle($cell)->getBorders();
                    $borders->getRight()->setBorderStyle('thin');
                }

                //Bottom,medium
                $cells = ['D1:E1', 'B38:K38', 'B4:K4', 'B7:K7', 'B17:K17', 'B27:K27'];
                foreach($cells as $cell)
                {
                    $borders = $sheet->getStyle($cell)->getBorders();
                    $borders->getBottom()->setBorderStyle('medium');
                }
               
                //Bottom,thin
                $cells = ['B12:K12', 'B22:K22', 'B32:K32'];
                foreach ($cells as $cell)
                {
                    $borders = $sheet->getStyle($cell)->getBorders();
                    $borders->getBottom()->setBorderStyle('thin');
                }
              
                //Bottom,dotted
                $cells = ['B8:K8', 'B9:K9', 'B10:K10', 'B11:K11', 'B13:K13', 'B14:K14', 'B15:K15', 'B16:K16', 'B18:K18',
                'B19:K19', 'B20:K20', 'B21:K21', 'B23:K23', 'B24:K24', 'B25:K25', 'B26:K26', 'B28:K28', 'B29:K29', 'B30:K30',
                'B31:K31', 'B33:K33', 'B34:K34', 'B35:K35', 'B36:K36', 'B37:K37'];
                foreach ($cells as $cell) 
                {
                    $borders = $sheet->getStyle($cell)->getBorders();
                    $borders->getBottom()->setBorderStyle('dotted');
                }
            }
        ];
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return $this->view;
    }
}
