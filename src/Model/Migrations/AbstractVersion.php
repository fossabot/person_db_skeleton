<?php
declare(strict_types=1);
/**
 * Contains class AbstractVersion.
 *
 * PHP version 7.3
 *
 * LICENSE:
 * This file is part of person_db_skeleton which is a set of skeleton database
 * tables for people and common associated data.
 *
 * Copyright (C) 2019 Michael Cummings. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation and/or
 * other materials provided with the distribution.
 *
 * 3. Neither the name of the copyright holder nor the names of its contributors
 * may be used to endorse or promote products derived from this software without
 * specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * You should have received a copy of the BSD-3 Clause License along with
 * this program. If not, see
 * <https://spdx.org/licenses/BSD-3-Clause.html>.
 *
 * You should be able to find a copy of this license in the LICENSE file.
 *
 * @author    Michael Cummings <mgcummings@yahoo.com>
 * @copyright 2019 Michael Cummings
 * @license   BSD-3-Clause
 */

namespace PersonDBSkeleton\Model\Migrations;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class AbstractVersion.
 */
abstract class AbstractVersion extends AbstractMigration {
    /**
     * @param string $sql
     */
    protected function executeSQL(string $sql): void {
        $statements = \explode(';', $sql);
        foreach ($statements as $statement) {
            if ('' !== \trim($statement)) {
                $this->addSql($statement);
            }
        }
    }
    /**
     * @param Schema $schema
     *
     * @throws DBALException
     */
    public function preDown(Schema $schema): void {
        /** @noinspection DegradedSwitchInspection */
        switch ($this->connection->getDatabasePlatform()
                                 ->getName()) {
            case 'mysql':
                $sql = /** @lang MySQL */
                    <<<'SQL'
                SET SESSION SQL_MODE = 'ANSI,TRADITIONAL';
                SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE;
                SET SESSION TIME_ZONE = '+00:00';
                SQL;
                $this->executeSQL($sql);
                break;
            default:
                // Nothing
        }
    }
    /**
     * @param Schema $schema
     *
     * @throws DBALException
     */
    public function preUp(Schema $schema): void {
        /** @noinspection DegradedSwitchInspection */
        switch ($this->connection->getDatabasePlatform()
                                 ->getName()) {
            case 'mysql':
                $sql = /** @lang MySQL */
                    <<<'SQL'
                SET SESSION SQL_MODE = 'ANSI,TRADITIONAL';
                SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE;
                SET SESSION TIME_ZONE = '+00:00';
                SQL;
                $this->executeSQL($sql);
                break;
            default:
                // Nothing
        }
    }
}
