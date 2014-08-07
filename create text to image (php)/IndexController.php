<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;


use Application\Helper\createImage;


class IndexController extends AbstractActionController
{
    
    /*
     * _COLLECTION ACTION
     */
    public function collectionAction()
    {     
        $this->createImg($request->getPost('content'), '-'.str_replace(" ", "", $author), $lastId, (int)$this->getUserTable()->getUser($user)->userId);
	
        return $this->redirect()->toRoute('application', array('action' => 'collection'));
    }

    public function keyword($content)
    {
        $random = rand(1,2);
        if(substr_count(strtoupper($content), "CHRISTMAS") != 0 || substr_count(strtoupper($content), "X-MAS") != 0 || substr_count(strtoupper($content), "XMAS") != 0 || substr_count(strtoupper($content), "PASKO") != 0){
            $path = array('patternChristmas', 'patternChristmasSmall',);
        }elseif(substr_count(strtoupper($content), "LOVE") != 0 || substr_count(strtoupper($content), "PUSO") != 0 || substr_count(strtoupper($content), "HEART") != 0 || substr_count(strtoupper($content), "PAG-IBIG") != 0 || substr_count(strtoupper($content), "PAGIBIG") != 0 || substr_count(strtoupper($content), "MAHAL") != 0 || substr_count(strtoupper($content), "FEBRUARY") != 0 || substr_count(strtoupper($content), "VALENTINE") != 0){
            $path = array('patternLove', 'patternLoveSmall',);
        }else{
            $path = array('patternNormal', 'patternNormalSmall',);
        }
        return $path[$random - 1];
    }

    
    public function createImg($content, $author, $postId, $userId)
    {
        if(strlen($content) > 104){
            $neg = 18;
        }elseif(strlen($content) > 69 && strlen($content) < 105){
            $neg = 17;
        }else{
            $neg = 16;
        }
        
        $keyword = $this->keyword($content); //public function keyword()
        
        $usingPath = $this->getImageTable()->usingPath($keyword);
        $random = rand(1, count($usingPath));
        
        foreach($usingPath as $img)
        {
            $arrFetch[] = $this->getImageTable()->usingPathCurrent($img['background_image_id']);
        }
        $fetch = $arrFetch[$random - 1];
        
        $imageName = $fetch['name'];
        $imagePath = $fetch['path'];
        $imageFontId = $fetch['font_id'];
        
        if($imageFontId == 0){
            $fetchFont = $this->getFontTable()->fetchFont();
            $randomFont = rand(1, count($fetchFont));
            
            foreach($fetchFont as $a){
                $arrFontName[] = $a['name'];
                $arrFontSize[] = $a['font_size'];
            }
            
            $fontName = $arrFontName[$randomFont - 1];
            $fontSizeA = $arrFontSize[$randomFont - 1] - $neg;
            $fontSize = rand($fontSizeA-5, $fontSizeA);
        } else{
            $fetchFont = $this->getFontTable()->fetchCurrentFont($imageFontId);
            $fontName = $fetchFont['name'];
            $fontSizeA = $fetchFont['font_size'] - $neg;
            $fontSize = rand($fontSizeA-5, $fontSizeA);
        }
        
        $fetchColor = $this->getImageTable()->fetchColor($fetch['background_image_id']);
        $randomColor = rand(1, count($fetchColor));
        foreach($fetchColor as $selectedColor){
            $hex[] = $selectedColor['hexdec'];
        }
        $color = $hex[$randomColor - 1];
        
        $imageCreator = new createImage();
        $imageCreator->imageCreator($content, $author, $postId, $userId, $imageName, $imagePath, $color, $fontName, $fontSize); 
    }
}
