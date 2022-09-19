# Magexo test project

New module for evidence Point Of Sale (aka POS)
Goal: is to create administration grid with ability to add new Point Of Sale then on front end list these POS in a simple list.

1. Create new custom POS entity
    1. DB Table pos_entity Fields: pos_id, name, address, is_available (bool)
    2. generate some random POS in table “Point Of Sale 1”, “Point oOf Sale 2", ... “Point Of Sale 100”
2. In Admin Panel add new CRUD Grid with list of Point Of Sale
    1. Add new menu Item “Point Of Sale” into the Content menu.
    2. Grid fields: POS Id, Name, Address, Is Availaible
    3. Functions Create, Update and Delete
3. Create console command to add new POS
    1. Add new console command magexo:pos:add with parameters: name, address and is_availaible

## Built using / Credits

[markshust/docker-magento](https://github.com/markshust/docker-magento)
