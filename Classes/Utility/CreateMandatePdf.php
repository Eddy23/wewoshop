<?php
namespace Wewo\Wewoshop\Utility;

/**
 * Class CreateMandatePdf

 */
class CreateMandatePdf {

    /**
     * Creates a pdf mandate
     *
     * @param $sepaPayee
     * @param $sepaCreditor
     * @param $mandateReference
     * @param $userName
     * @param $userAddress
     * @param $userZip
     * @param $userCity
     * @param $userEmail
     * @param $bic
     * @param $iban
     * @param $today
     * @param $directoryToMandate
     * @return void
     */
    public static function createMandate($sepaPayee, $sepaCreditor, $mandateReference, $userName, $userAddress, $userZip, $userCity, $userEmail, $bic, $iban, $today, $directoryToMandate) {
        $pdf = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('FPDF');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $html = "SEPA-Lastschrift-Mandat";
        $pdf->MultiCell(0, 20, $html, 0, 'L', 0);
        $pdf->SetFont('Arial', '', 12);
        $html = "Zahlungsempfaenger: $sepaPayee \nGlaeubiger-Identifikationsnummer: $sepaCreditor \nMandatsreferenz: $mandateReference \n";
        $pdf->MultiCell(0, 10, $html, 0, 'L', 0);
        $html = "\nIch ermaechtige den Zahlungsempfaenger, Zahlungen von meinem Konto mittel Lastschrift \neinzuziehen. Zugleich weise ich mein Kreditinstitut an, ";
        $html .= "die von dem Zahlungsempfaenger auf \nmein Konto gezogene Lastschriften einzuloesen. \n\n";
        $html .= "Hinweis: Ich kann innerhalb von acht Wochen, beginnend mit dem Belastungsdatum, die \nErstattung des belasteten Betrages verlangen. ";
        $html .= "Es gelten dabei die mit meinem Kreditinstitut \nvereinbarten Bedingungen.\n\n";
        $pdf->MultiCell(0, 10, $html, 0, 'L', 0);
        $html = "Name des Zahlungspflichtigen: $userName \nFirma: xyz-Firma \nStrasse und Hausnummer: $userAddress \nPostleitzahl/Ort: $userZip $userCity \nLand: xyz-Land \n";
        $html .= "E-Mail: $userEmail \nSwift BIC: $bic \nBankkontonummer - IBAN: $iban \n\n";
        $pdf->MultiCell(0, 10, $html, 0, 'L', 0);
        $html = "$userCity, $today, $userName";
        $pdf->MultiCell(0, 10, $html, 0, 'L', 0);
        $mandateFile = 'Lastschrift_Mandat_' . $mandateReference . '.pdf';
        $pdf->Output('fileadmin/' . $directoryToMandate . '/' . $mandateFile, 'F');
        return;
    }
}
