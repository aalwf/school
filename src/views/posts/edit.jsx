//import useState
import { useState, useEffect } from "react";

//import useNavigate
import { useNavigate, useParams } from "react-router-dom";

//import API
import api from "../../api";

export default function PostEdit() {
    // Mendefinisikan state
    const [image, setImage] = useState("");
    const [title, setTitle] = useState("");
    const [content, setContent] = useState("");

    // State untuk validasi
    const [errors, setErrors] = useState([]);

    // React Navigate
    const navigate = useNavigate();

    // Mengambil parameter "id" dari URL
    const { id } = useParams();

    // Method untuk menangani perubahan file
    const fetchDetailPost = async () => {
        // Fetch data dengan API
        await api.get(`/api/posts/${id}`).then((response) => {
            // Menetapkan response data ke state
            setTitle(response.data.data.title);
            setContent(response.data.data.content);
        });
    };

    // Mengambil detail post berdasarkan "id" pada saat halaman dimuat
    useEffect(() => {
        // Memanggil method "fetchDetailPost" untuk mengambil detail post
        fetchDetailPost();
    }, []);

    // Method untuk menangani perubahan file
    const handleFileChange = (e) => {
        setImage(e.target.files[0]);
    };

    // Method untuk menyimpan post
    const updatePost = async (e) => {
        e.preventDefault();

        // Inisialisasi FormData
        const formData = new FormData();

        // Menambahkan data
        formData.append("image", image);
        formData.append("title", title);
        formData.append("content", content);
        formData.append("_method", "PUT");

        // Mengirim data dengan Axios
        await api
            .post(`/api/posts/${id}`, formData)
            .then(() => {
                // Redirect ke halaman posts
                navigate("/posts");
            })
            .catch((error) => {
                // Set state "errors" dengan response API
                setErrors(error.response.data);
            });
    };

    return (
        <div className="container mt-5">
            <div className="row">
                <div className="col-md-12">
                    <div className="card border-0 rounded shadow">
                        <div className="card-body">
                            <form onSubmit={updatePost}>
                                <div className="mb-3">
                                    <label className="form-label fw-bold">
                                        Image
                                    </label>
                                    <input
                                        type="file"
                                        onChange={handleFileChange}
                                        className="form-control"
                                    />
                                    {errors.image && (
                                        <div className="alert alert-danger mt-2">
                                            {errors.image[0]}
                                        </div>
                                    )}
                                </div>

                                <div className="mb-3">
                                    <label className="form-label fw-bold">
                                        Title
                                    </label>
                                    <input
                                        type="text"
                                        className="form-control"
                                        value={title}
                                        onChange={(e) =>
                                            setTitle(e.target.value)
                                        }
                                        placeholder="Title Post"
                                    />
                                    {errors.title && (
                                        <div className="alert alert-danger mt-2">
                                            {errors.title[0]}
                                        </div>
                                    )}
                                </div>

                                <div className="mb-3">
                                    <label className="form-label fw-bold">
                                        Content
                                    </label>
                                    <textarea
                                        className="form-control"
                                        value={content}
                                        onChange={(e) =>
                                            setContent(e.target.value)
                                        }
                                        rows="5"
                                        placeholder="Content Post"
                                    ></textarea>
                                    {errors.content && (
                                        <div className="alert alert-danger mt-2">
                                            {errors.content[0]}
                                        </div>
                                    )}
                                </div>

                                <button
                                    type="submit"
                                    className="btn btn-md btn-primary rounded-sm shadow border-0"
                                >
                                    Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
