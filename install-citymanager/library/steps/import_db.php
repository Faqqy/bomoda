<?php

class ImportDb extends Step {

    public function run() {
        $this->install->queryFromFile('main.sql');
        $this->exportFromOldVersion();
        $this->fillCities();

        return true;
    }

    private function exportFromOldVersion() {
        $this->exportCities();
        $this->exportRedirects();
        $this->exportCurrencies();
        $this->exportMessages();
    }

    private function exportCities() {
        $total = $this->install->query("SELECT COUNT(*) total FROM `prmn_cm_city`")->row;
        if (!$total['total']) {
            $row = $this->install->query("SHOW TABLES LIKE 'geoip_city'")->row;
            if ($row) {
                $this->install->query("INSERT INTO `prmn_cm_city` (SELECT * FROM `geoip_city`)");
            }
        }
    }

    private function exportRedirects() {
        $total = $this->install->query("SELECT COUNT(*) total FROM `prmn_cm_redirect`")->row;
        if (!$total['total']) {
            $row = $this->install->query("SHOW TABLES LIKE 'geoip_redirect'")->row;
            if ($row) {
                $this->install->query("INSERT INTO `prmn_cm_redirect` (SELECT * FROM `geoip_redirect`)");
            }
        }
    }

    private function exportCurrencies() {
        $total = $this->install->query("SELECT COUNT(*) total FROM `prmn_cm_currency`")->row;
        if (!$total['total']) {
            $row = $this->install->query("SHOW TABLES LIKE 'geoip_currency'")->row;
            if ($row) {
                $this->install->query("INSERT INTO `prmn_cm_currency` (SELECT * FROM `geoip_currency`)");
            }
        }
    }

    private function exportMessages() {
        $total = $this->install->query("SELECT COUNT(*) total FROM `prmn_cm_message`")->row;
        if (!$total['total']) {
            $row = $this->install->query("SHOW TABLES LIKE 'geoip_rule'")->row;
            if ($row) {
                $this->install->query("INSERT INTO `prmn_cm_message` (SELECT * FROM `geoip_rule`)");
            }
        }
    }

    private function fillCities() {
        $row = $this->install->query("SELECT COUNT(*) total FROM `prmn_cm_city`")->row;
        if (!$row['total']) {
            $this->install->query(
                "INSERT INTO `prmn_cm_city` (`id`, `fias_id`, `name`) VALUES
                    (1, 41, 'Москва'), (2, 3145, 'Воронеж'), (3, 4187, 'Ростов-на-Дону'), (4, 3737, 'Саратов'), 
                    (5, 3187, 'Екатеринбург'), (6, 5033, 'Владивосток'), (7, 2638, 'Хабаровск'), 
                    (8, 86, 'Санкт-Петербург'), (9, 5147, 'Новосибирск'), (10, 2990, 'Нижний Новгород'), 
                    (11, 4006, 'Казань'), (12, 2782, 'Самара'), (13, 3704, 'Омск'), (14, 4778, 'Челябинск'), 
                    (15, 6125, 'Уфа'), (16, 3734, 'Волгоград'), (17, 3753, 'Красноярск'), (18, 4131, 'Пермь')"
            );
        }
    }
}
