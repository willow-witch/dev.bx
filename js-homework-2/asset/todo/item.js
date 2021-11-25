export class Item
{
	title;
	deleteButtonHandler;

	constructor({title, deleteButtonHandler})
	{
		this.title = String(title);
		if (typeof deleteButtonHandler === 'function')
		{
			this.deleteButtonHandler = deleteButtonHandler;
		}
	}

	getData()
	{
		return {title: this.title};
	}

	render()
	{
		const container = document.createElement('div');
		container.classList.add('item-container');
		const title = document.createElement('div');
		title.classList.add('item-title');
		title.innerText = this.title;
		container.append(title);

		const buttonsContainer = document.createElement('div');
		const deleteButton = document.createElement('button');
		deleteButton.setAttribute('id', 'btn-delete')
		deleteButton.innerText = 'Delete';
		buttonsContainer.append(deleteButton);
		deleteButton.addEventListener('click', this.handleDeleteButtonClick.bind(this));

		// container.append(buttonsContainer);

		const editButton = document.createElement('button');
		editButton.setAttribute('id', 'btn-edit')
		editButton.innerText = 'Edit';
		buttonsContainer.append(editButton);
		editButton.addEventListener('click', this.handleEditButtonClick.bind(this));

		container.append(buttonsContainer);

		return container;
	}

	handleDeleteButtonClick()
	{
		if (this.deleteButtonHandler)
		{
			this.deleteButtonHandler(this);
		}
	}

	handleEditButtonClick()
	{
		document.querySelector('[class="calendar-new-item-title"]').value = this.title;
		document.getElementById('btn-delete').click();
	}

}