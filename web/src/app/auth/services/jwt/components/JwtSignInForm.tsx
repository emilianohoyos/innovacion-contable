import { useForm, Controller } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import { useEffect, useState } from "react";
import { AxiosError } from "axios";
import { z } from "zod";
import _ from "@lodash";
import TextField from "@mui/material/TextField";
import FormControl from "@mui/material/FormControl";
import FormControlLabel from "@mui/material/FormControlLabel";
import Checkbox from "@mui/material/Checkbox";
import { Link } from "react-router-dom";
import Button from "@mui/material/Button";
import useJwtAuth from "../useJwtAuth";
import NotificationModel from "src/app/main/apps/notifications/models/NotificationModel";
import { closeSnackbar, enqueueSnackbar } from "notistack";
import NotificationTemplate from "src/app/main/apps/notifications/NotificationTemplate";
import { useCreateNotificationMutation } from "src/app/main/apps/notifications/NotificationApi";

/**
 * Form Validation Schema
 */
const schema = z.object({
  username: z.string().nonempty("Por favor ingresa un usuario."),
  password: z.string().nonempty("Por favor ingresar una contraseña."),
});

type FormType = {
  username: string;
  password: string;
  remember?: boolean;
};

const defaultValues = {
  username: "",
  password: "",
  remember: true,
};

function JwtSignInForm() {
  const [isLoading, setIsLoading] = useState<boolean>(false);
  const { signIn } = useJwtAuth();
  const [addNotification] = useCreateNotificationMutation();

  const { control, formState, handleSubmit, setValue, setError } =
    useForm<FormType>({
      mode: "onChange",
      defaultValues,
      resolver: zodResolver(schema),
    });

  const { isValid, dirtyFields, errors } = formState;

  function onSubmit(formData: FormType) {
    const { username, password } = formData;
    setIsLoading(true);

    signIn({
      username,
      password,
    })
      .then((e: any) => {
        if (e?.response?.status === 401) {
          setError("password", {
            type: "manual",
            message: "Usuario o contraseña incorrectos.",
          });
        }
        setIsLoading(false);
      })
      .catch((e) => {
        if (e?.response?.status === 401) {
          setError("password", {
            type: "manual",
            message: "Usuario o contraseña incorrectos.",
          });
        }
        setIsLoading(false);
      });
  }

  const error = () => {
    const item = NotificationModel({
      title: "Error al ingresar",
      description: " Usuario o contraseña incorrectos. ",
      variant: "error",
    });
    addNotification(item);
    enqueueSnackbar(item.title, {
      key: item.id,
      autoHideDuration: 6000,
      content: (
        <NotificationTemplate
          item={item}
          onClose={() => {
            closeSnackbar(item.id);
          }}
        />
      ),
    });
  };

  return (
    <form
      name="loginForm"
      noValidate
      className="mt-32 flex w-full flex-col justify-center"
      onSubmit={handleSubmit(onSubmit)}
    >
      <Controller
        name="username"
        control={control}
        render={({ field }) => (
          <TextField
            {...field}
            className="mb-24"
            label="Usuario"
            autoFocus
            type="text"
            error={!!errors.username}
            helperText={errors?.username?.message}
            variant="outlined"
            required
            fullWidth
          />
        )}
      />

      <Controller
        name="password"
        control={control}
        render={({ field }) => (
          <TextField
            {...field}
            className="mb-24"
            label="Contraseña"
            type="password"
            error={!!errors.password}
            helperText={errors?.password?.message}
            variant="outlined"
            required
            fullWidth
          />
        )}
      />

      <div className="flex flex-col items-center justify-center sm:flex-row sm:justify-between">
        <Controller
          name="remember"
          control={control}
          render={({ field }) => (
            <FormControl>
              <FormControlLabel
                label="Recordarme"
                control={<Checkbox size="small" {...field} />}
              />
            </FormControl>
          )}
        />

        <Link className="text-md font-medium" to="/pages/auth/forgot-password">
          ¿Olvidaste tu contraseña?
        </Link>
      </div>

      <Button
        variant="contained"
        color="secondary"
        className=" mt-16 w-full"
        aria-label="Sign in"
        disabled={_.isEmpty(dirtyFields) || !isValid || isLoading}
        type="submit"
        size="large"
      >
        Ingresar
      </Button>
    </form>
  );
}

export default JwtSignInForm;
