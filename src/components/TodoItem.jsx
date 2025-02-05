// Komponen TodoItem
const TodoItem = ({ todo }) => {
    return (
        // Menampilkan todo dari props yang dikirim oleh komponen TodoList
        <li className={`${todo.done ? "checked" : ""}`}>
            {todo.title} <span className="close">x</span>
        </li>
    );
};

export default TodoItem;
