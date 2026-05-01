<?php
/**
 * MINT SCRIPTS V1.0 - Binary Options Trading Engine
 * Logic for calculating trade results based on AI signals and Admin Win-Chance.
 */

namespace MintScripts\Core;

class TradingEngine {
    
    private $winChance; // Настраиваемый шанс из config.php

    public function __construct($configWinChance = 55) {
        $this->winChance = $configWinChance;
    }

    /**
     * Расчет результата сделки
     * @param float $entryPrice Цена входа
     * @param float $exitPrice Цена выхода (из API/Websocket)
     * @param string $direction Направление ('up' или 'down')
     * @return bool
     */
    public function calculateResult($entryPrice, $exitPrice, $direction) {
        // Симуляция алгоритма коррекции шанса (Win Chance Logic)
        $systemDecision = (rand(1, 100) <= $this->winChance);
        
        if ($direction === 'up') {
            return $exitPrice > $entryPrice && $systemDecision;
        } else {
            return $exitPrice < $entryPrice && $systemDecision;
        }
    }

    /**
     * AI Аналитика (Демонстрация работы предиктора)
     */
    public function getAISignal($pair) {
        $indicators = ['RSI' => rand(30, 70), 'Volatility' => 'High', 'Trend' => 'Bullish'];
        $confidence = rand(60, 95);
        
        return [
            'signal' => ($indicators['RSI'] < 50) ? 'CALL (UP)' : 'PUT (DOWN)',
            'confidence' => $confidence . '%',
            'analysis' => "AI analyzed $pair based on RSI and current Market Trend."
        ];
    }
}

// Пример инициализации для тестов:
$engine = new TradingEngine(60); // Установка шанса на 60%
$aiForecast = $engine->getAISignal('BTC/USDT');

echo "AI Signal: " . $aiForecast['signal'] . " with " . $aiForecast['confidence'] . " confidence.";