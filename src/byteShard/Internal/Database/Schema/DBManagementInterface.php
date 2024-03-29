<?php
/**
 * @copyright  Copyright (c) 2009 Bespin Studios GmbH
 * @license    See LICENSE file that is distributed with this source code
 */

namespace byteShard\Internal\Database\Schema;

use byteShard\Database\Schema\Column;
use byteShard\Database\Schema\Index;
use byteShard\Database\Schema\Table;
use byteShard\Exception;
use byteShard\Internal\Database\BaseConnection;
use byteShard\Enum;

interface DBManagementInterface
{

    public function __construct(BaseConnection $connection, string $database, ?string $schema);

    public function execute(string $command): void;

    /**
     * @return ColumnManagementInterface[]
     */
    public function getColumns(TableManagementInterface $table): array;

    /**
     * @return array<int|string,Grants>
     */
    public function getGrants(TableManagementInterface $table): array;

    /**
     * @return array<IndexManagementInterface>
     */
    public function getIndices(TableManagementInterface $table): array;

    /**
     * @return array<string, string>
     */
    public function getPrimaryKeyColumns(TableManagementInterface $table): array;

    public function getPrimaryKeyName(TableManagementInterface $table): string;

    public function getTableComment(string $table): string;

    /**
     * @return array<TableManagementInterface>
     */
    public function getTables(bool $sorted = false): array;

    /**
     * @param string $type
     * @param string $value
     * @param string|null $initialVersion
     * @return string|null
     */
    public function getVersion(string $type = 'bs_schema', string $value = 'version_identifier', ?string $initialVersion = 'v0.0.0'): ?string;

    public function databaseExists(): bool;

    public function selectDatabase(): bool;

    public function createAndSelectDatabase(): bool;

    public function setDryRun(bool $dryRun): static;

    /**
     * @param array<string> $dryRunCommands
     */
    public function setDryRunCommandArrayReference(array &$dryRunCommands): static;

    /**
     * @param array<string, string> $parameters
     */
    public function setSchemaParameters(array $parameters): static;

    public function setVersion(string $type = 'bs_schema', string $value = 'version_identifier', string $version = 'v0.0.0'): static;

    public function tableExists(string $table): bool;

    /**
     * @param TableManagementInterface $table
     * @return array<string, ForeignKeyInterface>
     */
    public function getForeignKeys(TableManagementInterface $table): array;


    /**
     * @param string $columnUserID
     * @param string $tableName
     * @param string $columnUsername
     * @param string $username
     * @param array<string, string|int|null> $params
     * @return bool
     * @throws Exception
     */
    public function createOrUpdateAdminUser(string $columnUserID, string $tableName, string $columnUsername, string $username, array $params): bool;

}
